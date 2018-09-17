@api
Feature: Content broker
  In order to be able to showcase the content broker functionality
  As an Administrator user
  I want to make sure that each site is consuming only specific type of content

  @site-energy
  Scenario: The ENERGY site consumes announcements and events
    Given I am logged in with a user that can access the RDF content overview page
    And I visit "the RDF content administration page"

    Then I should see the following links:
    | Over €300 million available now to energy projects	                            |
    | EU-funded researchers set a new energy efficiency record for solar cells      	|
    | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |
    | Horizon 2020 Energy info day	                                                    |
    | EU Sustainable Energy Week (EUSEW) 2018	                                        |
    | Horizon 2020 Transport virtual info day	                                        |

    But I should not see the following links:
    | Directorate-General for Environment	         |
    | Innovation and Networks Executive Agency	     |
    | Directorate-General for Energy	             |
    | Financing Energy Efficiency in Malta and Italy |
    | EU Energy Day at COP24, COP24 EU Pavilion	     |
    | EU Green Week 2019	                         |

  @site-inea
  Scenario: The INEA site produces announcements and events
    Given I am logged in with a user that can access the RDF content overview page
    And I visit "the RDF content administration page"

    Then I should see the following links:
    | Over €300 million available now to energy projects	                            |
    | EU-funded researchers set a new energy efficiency record for solar cells      	|
    | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |
    | Horizon 2020 Energy info day	                                                    |
    | EU Sustainable Energy Week (EUSEW) 2018	                                        |
    | Horizon 2020 Transport virtual info day	                                        |

    But I should not see the following links:
    | Directorate-General for Environment	         |
    | Innovation and Networks Executive Agency	     |
    | Directorate-General for Energy	             |
    | Financing Energy Efficiency in Malta and Italy |
    | EU Energy Day at COP24, COP24 EU Pavilion	     |
    | EU Green Week 2019	                         |

  @site-info
  Scenario: The INFO site produces departments and events and consumes announcements
    Given I am logged in with a user that can access the RDF content overview page
    And I visit "the RDF content administration page"

    Then I should see the following links:
    | Over €300 million available now to energy projects	                            |
    | EU-funded researchers set a new energy efficiency record for solar cells      	|
    | Spain's first self-installing offshore wind turbine arrives to the Canary Islands |
    | Directorate-General for Environment	         |
    | Innovation and Networks Executive Agency	     |
    | Directorate-General for Energy	             |
    | Financing Energy Efficiency in Malta and Italy |
    | EU Energy Day at COP24, COP24 EU Pavilion	     |
    | EU Green Week 2019	                         |

    But I should not see the following links:
    | Horizon 2020 Energy info day	             |
    | EU Sustainable Energy Week (EUSEW) 2018	 |
    | Horizon 2020 Transport virtual info day	 |
