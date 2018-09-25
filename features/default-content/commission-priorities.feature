@api @site-info
Feature: Default content 'Commission / Priorities'
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  Scenario: Commission landing page content is correctly imported
    When I am on "the priorities page"

    Then I should be on "/en/commission/priorities"

    Then the site switcher link "Commission and its priorities" is active
    But the site switcher link "Policies, information and services" is not active

    And I should see the link "Home" in the "breadcrumb" region

    And I should see the heading "Priorities" in the "page header" region

    # Menu page contents
    And I should see the following links in the "content" region:
      | 10 Commission priorities for 2015-19                              |
      | Documents                                                         |
      | Related links                                                     |

    # 10 Commission priorities for 2015-19
    And I should see the following links in the "content" region:
      | Jobs, growth and investment                                       |
      | Digital single market                                             |
      | Energy union and climate                                          |
      | Internal market                                                   |

    # Documents
    And I should see the following links in the "content" region:
      | President Juncker's Political Guidelines                          |
      | Summary of President Juncker's Political Guidelines               |

    # Related links
    And I should see the following links in the "content" region:
      | White Paper on the future of Europe                               |
      | State of the Union 2017                                           |
      | The 2018 Work Programme                                           |
      | Joint Declaration on the EU's legislative priorities for 2017     |

    # Switch to French content
    When I open the language switcher dialog
    And I click "français" in the "language switcher"

    Then I should be on "/fr/commission/priorities"

    Then the site switcher link "La Commission et ses priorités" is active
    But the site switcher link "Politiques, informations et services" is not active

    And I should see the heading "Priorités" in the "page header" region

    # Menu page contents
    And I should see the following links in the "content" region:
      | 10 priorités de la Commission européenne pour 2014-19             |
      | Documents                                                         |
      | Autres liens                                                      |

    # 10 Commission priorities for 2015-19
    And I should see the following links in the "content" region:
      | Emploi, croissance et investissement                              |
      | Marché unique numérique                                           |
      | Union de l'énergie et climat                                      |
      | Marché intérieur                                                  |

    # Documents
    And I should see the following links in the "content" region:
      | Les orientations politiques du président Juncker                  |
      | Summary of President Juncker's Political Guidelines               |

    # Related links
    And I should see the following links in the "content" region:
      | Livre blanc sur l'avenir de l'Europe                                                           |
      | L'État de l'Union 2017                                                                         |
      | Programme de travail 2018                                                                      |
      | Déclaration commune sur les priorités législatives de l’Union européenne pour l’année 2017     |

    # Switch to Italian content
    When I open the language switcher dialog
    And I click "italiano" in the "language switcher"

    Then I should be on "/it/commission/priorities"

    Then the site switcher link "Le priorità della Commissione" is active
    But the site switcher link "Politiche, informazioni e servizi" is not active

    And I should see the link "Home" in the "breadcrumb" region

    And I should see the heading "Priorità" in the "page header" region

    # Menu page contents
    And I should see the following links in the "content" region:
      | Le 10 priorità della Commissione per il 2015-2019                 |
      | Documenti                                                         |
      | Link correlati                                                    |

    # 10 Commission priorities for 2015-19
    And I should see the following links in the "content" region:
      | Occupazione, crescita e investimenti                              |
      | Mercato unico digitale                                            |
      | Unione dell'energia e clima                                       |
      | Mercato interno                                                   |

    # Documents
    And I should see the following links in the "content" region:
      | Orientamenti politici del presidente Juncker                      |
      | Summary of President Juncker's Political Guidelines               |

    # Related links
    And I should see the following links in the "content" region:
      | Libro bianco sul futuro dell'Europa                                  |
      | Stato dell'Unione 2017                                               |
      | The 2018 Work Programme                                              |
      | Dichiarazione comune sulle priorità legislative dell’UE per il 2017  |
