@api @run
Feature: Default content
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  Scenario: Commission landing page content is correctly imported
    When I am on "the jobs growth and investment page"
    And I click "English"
    
    # Then I should be on "/en/commission/priorities/jobs-growth-and-investment"
    Then I should be on "/en/priorities/jobs-growth-and-investment"

    # Then the site switcher link "Commission and its priorities" is active
    But the site switcher link "Policies, information and services" is not active

    And I should see the heading "Jobs, growth and investment" in the "page header" region
    And I should see the link "Home" in the "breadcrumb" region
    # And I should see the link "Priorities" in the "breadcrumb" region
    
    And I should see the link "The Investment Plan for Europe" in the "content" region

    # Menu page contents
    And I should see the following links in the "content" region:
      | Policy areas                                                      |
      | Latest                                                            |
      | Background                                                        |
      | Document                                                          |

    # Policy areas region
    And I should see the following links in the "content" region:
      | Investment Plan for Europe: the Juncker Plan                      |
      | European Semester                                                 |
      | Towards a circular economy                                        |

    # Latest region
    And I should see the following links in the "content" region:
      | EIB and SaarLB drive renewable energy development with support from Juncker Plan                                                                                                        |
      | European Innovation Scoreboard 2018: Europe must deepen its innovation edge                                                                                                             |
      | The European Investment Fund and Erste Group sign a EUR 50 million deal to finance social enterprises in Austria, Croatia, the Czech Republic, Hungary, Romania, Slovakia and Serbia    |
    And I should see the link "ALL NEWS ON THIS PRIORITY" in the "content" region

    # Document region
      | The European Commission's contribution to the Leaders' meeting in Gothenburg, 17 November 2017   |
      | The European Semester: 2017 Country Reports                                                      |
      | The Investment Plan: Two years on                                                                |

    #switch to Italian content
    When I open the language switcher dialog
    And I click "italiano" in the "language switcher"

    # Then the site switcher link "Le priorità della Commissione" is active
    But the site switcher link "Politiche, informazioni e servizi" is not active

    And I should see the heading "Jobs, growth and investment" in the "page header" region
    And I should see the link "Home" in the "breadcrumb" region
    # And I should see the link "Priorities" in the "breadcrumb" region
    
    And I should see the link "The Investment Plan for Europe" in the "content" region

    # Menu page contents
    And I should see the following links in the "content" region:
      | Policy areas                                                      |
      | Latest                                                            |
      | Background                                                        |
      | Document                                                          |

    # Policy areas region
    And I should see the following links in the "content" region:
      | Investment Plan for Europe: the Juncker Plan                      |
      | European Semester                                                 |
      | Towards a circular economy                                        |

    # Latest region
    And I should see the following links in the "content" region:
      | EIB and SaarLB drive renewable energy development with support from Juncker Plan                                                                                                        |
      | European Innovation Scoreboard 2018: Europe must deepen its innovation edge                                                                                                             |
      | The European Investment Fund and Erste Group sign a EUR 50 million deal to finance social enterprises in Austria, Croatia, the Czech Republic, Hungary, Romania, Slovakia and Serbia    |
    And I should see the link "ALL NEWS ON THIS PRIORITY" in the "content" region

    # Document region
      | The European Commission's contribution to the Leaders' meeting in Gothenburg, 17 November 2017   |
      | The European Semester: 2017 Country Reports                                                      |
      | The Investment Plan: Two years on                                                                |
