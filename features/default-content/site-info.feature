@api @site-info
Feature: Default content for INFO site
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  Scenario: INFO homepage is correctly imported
    When I am on "the front page"
    And I click "English"

    Then the site switcher link "Policies, information and services" is active
    But the site switcher link "Commission and its priorities" is not active

    Then I should see the heading "Your guide to policies, information and services" in the "page header" region
    And I should see the following links in the "content" region:
      | Business, Economy, Euro                           |
      | Live, work, travel in the EU                      |
      | Law                                               |
      | About the European Commission                     |
      | Funding, Tenders                                  |
      | EU funding, grants, tenders, and how to apply.    |
      | Research and innovation                           |
      | Energy, Climate change, Environment               |
      | Strategy                                          |
      | Education                                         |
      | Aid, Development cooperation, Fundamental rights  |
      | Jobs at the European Commission                   |
      | Statistics                                        |
      | Food, Farming, Fisheries                          |
      | EU regional and urban development                 |
      | Research and innovation                           |
      | OpenEuropa                                        |

    And I should see the following links in the "content" region:
      | EU budget for the future                          |
      | White paper on the future of Europe               |
      | EU solidarity                                     |

    # Switch to French content
    When I open the language switcher dialog
    And I click "français" in the "language switcher"

    Then I should see the heading "Politiques, informations et services en un coup d'œil" in the "page header" region
    And I should see the following links in the "content" region:
      | Entreprises, économie et euro                               |
      | Vivre, travailler et voyager dans l’UE                      |
      | Législation                                                 |
      | À propos de la Commission européenne                        |
      | Financement, appels d’offres                                |
      | Recherche et innovation                                     |
      | Énergie, changement climatique, environnement               |
      | Stratégie                                                   |
      | Éducation                                                   |
      | Aide, coopération au développement et droits fondamentaux   |
      | Travailler à la Commission européenne                       |
      | Statistiques                                                |
      | Alimentation, agriculture, pêche                            |
      | Développement régional et urbain de l’UE                    |
      | Recherche et innovation                                     |
      | OpenEuropa                                                  |

    And I should see the following links in the "content" region:
      | Budget du future de UE                                      |
      | Livre blanc sur l'avenir de l'Europe                        |
      | Solidarité de l'UE                                          |

    # Switch to Italian content
    When I open the language switcher dialog
    And I click "italiano" in the "language switcher"

    Then I should see the heading "La tua guida alle politiche, alle informazioni e ai servizi" in the "page header" region
    And I should see the following links in the "content" region:
      | Imprese, economia, euro                                     |
      | Vivere, lavorare, viaggiare nell'UE                         |
      | Diritto                                                     |
      | La Commissione europea                                      |
      | Ricerca e innovazione                                       |
      | Energia, cambiamenti climatici, ambiente                    |
      | Strategia                                                   |
      | Istruzione                                                  |
      | Aiuti, cooperazione allo sviluppo, diritti fondamentali     |
      | Lavorare alla Commissione europea                           |
      | Statistiche                                                 |
      | Alimentazione, agricoltura, pesca                           |
      | Sviluppo regionale e urbano nell'UE                         |
      | Strategia                                                   |
      | OpenEuropa                                                  |

    And I should see the following links in the "content" region:
      | Bilancio dell'UE per il futuro                              |
      | Libro bianco sul futuro dell'Europa                         |
      | Solidarietà dell'UE                                         |
