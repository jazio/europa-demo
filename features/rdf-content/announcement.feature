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

  Scenario: The ENERGY site should lists news from the INEA site tagged with "energy policy" on the news listing page
    Given I am on "the news page" page of the "energy" site

    # Announcement produced by the INEA site tagged with "energy policy"
    Then I should see the following links:
    | Over €300 million available now to energy projects	                            |
    | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |

    # Events produced by the INEA site not tagged with "energy policy"
    And I should not see the following links:
    | EU-funded researchers set a new energy efficiency record for solar cells      	|

  Scenario: The INFO site should lists news from the INEA site
    Given I am on "the news page" page of the "info" site

    # Announcement produced by the INEA site tagged with "energy policy"
    Then I should see the following links:
    | Over €300 million available now to energy projects	                            |
    | EU-funded researchers set a new energy efficiency record for solar cells      	|
    | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |

  Scenario: The INEA site should lists its own news on the news listing page
    Given I am on "the news page" page of the "inea" site

    # Announcement produced by the INEA site
    Then I should see the following links:
    | Over €300 million available now to energy projects	                            |
    | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |
    | EU-funded researchers set a new energy efficiency record for solar cells      	|
