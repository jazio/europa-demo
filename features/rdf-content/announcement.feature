@sites-all
Feature: Announcements
  In order to be able to showcase the announcements
  As an Anonymous user
  I want to make sure that announcements can be correctly accessed and seen

  Scenario Outline: Announcements should be visible on all 3 sites
    Given I go to the RDF entity page "<title>" on the "<site>" site
    Then I should see the "<title>" in the "header title"

    Examples:
    | title                                                                             | site |
    | Over €300 million available now to energy projects                                | inea |
    | EU-funded researchers set a new energy efficiency record for solar cells          | inea |
    | Spain's first self-installing offshore wind turbine arrives to the Canary Islands | inea |
    | Over €300 million available now to energy projects                                | info |
    | EU-funded researchers set a new energy efficiency record for solar cells          | info |
    | Spain's first self-installing offshore wind turbine arrives to the Canary Islands | info |
    | Over €300 million available now to energy projects                                | energy |
    | EU-funded researchers set a new energy efficiency record for solar cells          | energy |
    | Spain's first self-installing offshore wind turbine arrives to the Canary Islands | energy |
