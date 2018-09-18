@sites-all
Feature: Events
  In order to be able to showcase the events
  As an Anonymous user
  I want to make sure that events can be correctly accessed and seen

  Scenario Outline: Events from the Info site should be visible on the Info site
    Given I go to the RDF entity page "<title>" on the "<site>" site
    Then I should see the "<title>" in the "header title"

    Examples:
      | title                                          | site |
      | Financing Energy Efficiency in Malta and Italy | info |
      | EU Energy Day at COP24, COP24 EU Pavilion      | info |
      | EU Green Week 2019                             | info |

  Scenario Outline: Events from the Info site should not be visible on the INEA or Energy sites
    Given I go to the RDF entity page "<title>" on the "<site>" site
    Then I should see the "Access denied" in the "header title"

    Examples:
      | title                                          | site |
      | Financing Energy Efficiency in Malta and Italy | inea |
      | EU Energy Day at COP24, COP24 EU Pavilion      | inea |
      | EU Green Week 2019                             | inea |
      | Financing Energy Efficiency in Malta and Italy | energy |
      | EU Energy Day at COP24, COP24 EU Pavilion      | energy |
      | EU Green Week 2019                             | energy |

  Scenario Outline: Events from the Inea site should be visible on the Inea and Energy sites
    Given I go to the RDF entity page "<title>" on the "<site>" site
    Then I should see the "<title>" in the "header title"

    Examples:
      | title                                   | site |
      | Horizon 2020 Transport virtual info day | inea |
      | Horizon 2020 Energy info day            | inea |
      | EU Sustainable Energy Week (EUSEW) 2018 | inea |
      | Horizon 2020 Transport virtual info day | energy |
      | Horizon 2020 Energy info day            | energy |
      | EU Sustainable Energy Week (EUSEW) 2018 | energy |

  Scenario Outline: Events from the Inea site should not be visible on the Info site
    Given I go to the RDF entity page "<title>" on the "<site>" site
    Then I should see the "Access denied" in the "header title"

    Examples:
      | title                                   | site |
      | Horizon 2020 Transport virtual info day | info |
      | Horizon 2020 Energy info day            | info |
      | EU Sustainable Energy Week (EUSEW) 2018 | info |

  Scenario: The ENERGY site should lists events from the INEA but not from the INFO site on its events listing page
    Given I am on "the events page" page of the "energy" site

    # Events produced by the INEA site
    Then I should see the following links:
      | Horizon 2020 Energy info day	        |
      | EU Sustainable Energy Week (EUSEW) 2018 |
      | Horizon 2020 Transport virtual info day |

    # Events produced by the INFO site
    But I should not see the following links:
      | Financing Energy Efficiency in Malta and Italy |
      | EU Energy Day at COP24, COP24 EU Pavilion      |
      | EU Green Week 2019                             |

  Scenario: The INFO site should lists only its own events on the events listing page
    Given I am on "the events page" page of the "info" site

    # Events produced by the INFO site
    Then I should see the following links:
      | Financing Energy Efficiency in Malta and Italy |
      | EU Energy Day at COP24, COP24 EU Pavilion      |
      | EU Green Week 2019                             |

    # Events produced by the INEA site
    But I should not see the following links:
      | Horizon 2020 Energy info day	        |
      | EU Sustainable Energy Week (EUSEW) 2018 |
      | Horizon 2020 Transport virtual info day |

  Scenario: The INEA site should lists only its own events on its events listing page
    Given I am on "the events page" page of the "energy" site

    # Events produced by the INEA site
    Then I should see the following links:
      | Horizon 2020 Energy info day	        |
      | EU Sustainable Energy Week (EUSEW) 2018 |
      | Horizon 2020 Transport virtual info day |

    # Events produced by the INFO site
    But I should not see the following links:
      | Financing Energy Efficiency in Malta and Italy |
      | EU Energy Day at COP24, COP24 EU Pavilion      |
      | EU Green Week 2019                             |
