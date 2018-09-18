@sites-all
Feature: Linked data
  In order to showcase how content is consumed on the different sites
  As a site visitor
  I should be able to navigate to the actual content pages on their respective producer sites

  Scenario Outline: Consumed content on the ENERGY site should be linked to its provenience page
    When I am on "the <page> page" page of the "energy" site

    And I follow "<title>"
    Then I should be on the "<site>" site
    And I should see the "<title>" in the "header title"

    Examples:
      | page   | title                                                                             | site |
      | events | EU Sustainable Energy Week (EUSEW) 2018                                           | inea |
      | events | Horizon 2020 Energy info day                                                      | inea |
      | events | Horizon 2020 Transport virtual info day                                           | inea |
      | news   | Over €300 million available now to energy projects                                | inea |
      | news   | Spain's first self-installing offshore wind turbine arrives to the Canary Islands | inea |

  Scenario Outline: Consumed announcements on the INFO site should be linked to its provenience page
    When I am on "the news page" page of the "info" site

    And I follow "<title>"
    Then I should be on the "<site>" site
    And I should see the "<title>" in the "header title"

    Examples:
      | title                                                                             | site |
      | Over €300 million available now to energy projects                                | inea |
      | Spain's first self-installing offshore wind turbine arrives to the Canary Islands | inea |
      | EU-funded researchers set a new energy efficiency record for solar cells          | inea |

  Scenario Outline: Departments on the INFO site should contain announcements coming from INEA
    Given I go to the RDF entity page "<department>" on the "info" site
    When I follow "<announcement>"
    Then I should be on the "inea" site
    And I should see the "<announcement>" in the "header title"

    Examples:
    | department                               | announcement                                                                      |
    | Directorate-General for Environment      | Over €300 million available now to energy projects                                |
    | Directorate-General for Environment      | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |
    | Innovation and Networks Executive Agency | Over €300 million available now to energy projects                                |
    | Innovation and Networks Executive Agency | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |
    | Directorate-General for Energy           | Over €300 million available now to energy projects                                |
    | Directorate-General for Energy           | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |

  Scenario Outline: Announcements and events contains a link to their related department page
    Given I go to the RDF entity page "<title>" on the "<site>" site
    And I follow "<department>"
    Then I should be on the "info" site
    And I should see the "<department>" in the "header title"

    Examples:
      | site | title                                                                             | department                               |
      | info | Financing Energy Efficiency in Malta and Italy                                    | Directorate-General for Energy           |
      | info | EU Energy Day at COP24, COP24 EU Pavilion                                         | Directorate-General for Energy           |
      | info | EU Green Week 2019                                                                | Directorate-General for Environment      |
      | inea | Over €300 million available now to energy projects                                | Innovation and Networks Executive Agency |
      | inea | EU-funded researchers set a new energy efficiency record for solar cells          | Innovation and Networks Executive Agency |
      | inea | Spain's first self-installing offshore wind turbine arrives to the Canary Islands | Innovation and Networks Executive Agency |
      | inea | Horizon 2020 Energy info day                                                      | Innovation and Networks Executive Agency |
      | inea | EU Sustainable Energy Week (EUSEW) 2018                                           | Directorate-General for Energy           |
      | inea | Horizon 2020 Transport virtual info day                                           | Innovation and Networks Executive Agency |
