@api @site-info
Feature: Default content 'Commission / Priorities / Jobs, growth and investment'
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  Scenario: Commission landing page content is correctly imported
    When I am on "the jobs growth and investment page"

    Then I should be on "/en/commission/priorities/jobs-growth-and-investment"

    Then the site switcher link "Commission and its priorities" is active
    But the site switcher link "Policies, information and services" is not active

    And I should see the link "Home" in the "breadcrumb" region
    And I should see the link "Priorities" in the "breadcrumb" region

    And I should see the heading "Jobs, growth and investment" in the "page header" region

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
    And I should see the following links in the "content" region:
      | The European Commission's contribution to the Leaders' meeting in Gothenburg, 17 November 2017   |
      | The European Semester: 2017 Country Reports                                                      |
      | The Investment Plan: Two years on                                                                |

    # Switch to French content
    When I open the language switcher dialog
    And I click "français" in the "language switcher"

    Then I should be on "/fr/commission/priorities/jobs-growth-and-investment"

    Then the site switcher link "La Commission et ses priorités" is active
    But the site switcher link "Politiques, informations et services" is not active

    And I should see the link "Priorités" in the "breadcrumb" region

    And I should see the heading "Emploi, croissance et investissement" in the "page header" region

    And I should see the link "Le plan d'investissement pour l'Europe" in the "content" region

    # Menu page contents
    And I should see the following links in the "content" region:
      | Domaines d'action                                                 |
      | Actualité                                                         |
      | Contexte                                                          |
      | Documents                                                         |

    # Policy areas region
    And I should see the following links in the "content" region:
      | Plan d’investissement pour l’Europe: le plan Juncker              |
      | Le semestre européen                                              |
      | Towards a circular economy                                        |

    # Latest region
    And I should see the following links in the "content" region:
      | La BEI et SaarLB appuient le développement des énergies renouvelables dans le cadre du Plan Juncker                                                                                     |
      | European Innovation Scoreboard 2018: Europe must deepen its innovation edge                                                                                                             |
      | The European Investment Fund and Erste Group sign a EUR 50 million deal to finance social enterprises in Austria, Croatia, the Czech Republic, Hungary, Romania, Slovakia and Serbia    |
    And I should see the link "ALL NEWS ON THIS PRIORITY" in the "content" region

    # Document region
    And I should see the following links in the "content" region:
      | The European Commission's contribution to the Leaders' meeting in Gothenburg, 17 November 2017   |
      | Le semestre européen: 2017 Rapports par pays                                                     |
      | Le plan d'investissement: eux ans déjà                                                           |

    # Switch to Italian content
    When I open the language switcher dialog
    And I click "italiano" in the "language switcher"

    Then I should be on "/it/commission/priorities/jobs-growth-and-investment"

    Then the site switcher link "Le priorità della Commissione" is active
    But the site switcher link "Politiche, informazioni e servizi" is not active

    And I should see the link "Home" in the "breadcrumb" region
    And I should see the link "Priorità" in the "breadcrumb" region

    And I should see the heading "Occupazione, crescita e investimenti" in the "page header" region

    And I should see the link "Piano di investimenti per l'Europa" in the "content" region

    # Menu page contents
    And I should see the following links in the "content" region:
      | Settori di attività                                               |
      | Novità                                                            |
      | Contesto                                                          |
      | Documenti                                                         |

    # Policy areas region
    And I should see the following links in the "content" region:
      | Piano di investimenti per l'Europa: il piano Juncker              |
      | Semestre europeo                                                  |
      | Verso un’economia circolare                                       |

    # Latest region
    And I should see the following links in the "content" region:
      | EIB and SaarLB drive renewable energy development with support from Juncker Plan                                                                                                        |
      | European Innovation Scoreboard 2018: Europe must deepen its innovation edge                                                                                                             |
      | The European Investment Fund and Erste Group sign a EUR 50 million deal to finance social enterprises in Austria, Croatia, the Czech Republic, Hungary, Romania, Slovakia and Serbia    |
    And I should see the link "ALL NEWS ON THIS PRIORITY" in the "content" region

    # Document region
    And I should see the following links in the "content" region:
      | The European Commission's contribution to the Leaders' meeting in Gothenburg, 17 November 2017   |
      | The European Semester: 2017 Country Reports                                                      |
      | The Investment Plan: Two years on                                                                |
