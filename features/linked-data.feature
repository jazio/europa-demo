# Since RDF IDs are based on "http://localhost" the following tests will fail on Drone.
# @todo: fix this.
@wip
Feature: Linked data
  In order to showcase how content is consumed on the different sites
  As a site visitor
  I should be able to navigate to the actual content pages on their respective producer sites

  @sites-all
  Scenario Outline: Consumed content on the ENERGY site should be linked to their provenience page
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

  @sites-all
  Scenario Outline: Consumed announcements on the INFO site should be linked to their provenience page
    When I am on "the news page" page of the "info" site

    And I follow "<title>"
    Then I should be on the "<site>" site
    And I should see the "<title>" in the "header title"

    Examples:
      | title                                                                             | site |
      | Over €300 million available now to energy projects                                | inea |
      | Spain's first self-installing offshore wind turbine arrives to the Canary Islands | inea |
      | EU-funded researchers set a new energy efficiency record for solar cells          | inea |

  @sites-all
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

  @sites-all
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

    @api @site-inea
    Scenario Outline: New INEA announcements tagged with "energy policy" will be displayed on INFO site's department pages

      Given the following announcements:
        | title                            | subject       |
        | Announcement about energy policy | energy policy |
        | Announcement about innovation    | innovation    |

      When I go to the RDF entity page "<department>" on the "info" site
      Then I should not see the following links:
        | Announcement about energy policy                                                  |
        | Over €300 million available now to energy projects                                |
        | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |
      But I should not see the following links:
        | Announcement about innovation |

      Examples:
        | department                               |
        | Directorate-General for Environment      |
        | Innovation and Networks Executive Agency |
        | Directorate-General for Energy           |
