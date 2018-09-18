@sites-all
Feature: Linked data
  In order to showcase how content is consumed on the different sites
  As a site visitor
  I should be able to navigate to the actual content pages on their respective producer sites

  Scenario Outline: Consumed content on the ENERGY site should be linked to its provenience page
    When I am on "the <page> page" page of the "energy" site

    And I follow "<title>"
    Then I should be on the "<site>" site
    And I should see "<title>"

    Examples:
    | page   | title                                                                             | site |
    | events | EU Sustainable Energy Week (EUSEW) 2018                                           | inea |
    | events | Horizon 2020 Energy info day                                                      | inea |
    | events | Horizon 2020 Transport virtual info day                                           | inea |
    | news   | Over €300 million available now to energy projects                                | inea |
    | news   | Spain's first self-installing offshore wind turbine arrives to the Canary Islands | inea |

  Scenario Outline: Consumed content on the INFO site should be linked to its provenience page
    When I am on "the news page" page of the "info" site

    And I follow "<title>"
    Then I should be on the "<site>" site
    And I should see "<title>"

    Examples:
      | title                                                                             | site |
      | Over €300 million available now to energy projects                                | inea |
      | Spain's first self-installing offshore wind turbine arrives to the Canary Islands | inea |
      | EU-funded researchers set a new energy efficiency record for solar cells          | inea |