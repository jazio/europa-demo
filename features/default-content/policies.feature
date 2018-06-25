@api
Feature: Default content
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  Scenario: Priorities landing page content is correctly imported
    When I am on the homepage
    And I click "English"
    And I click "Policies, information and services"

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