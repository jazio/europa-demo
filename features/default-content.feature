@api
Feature: Default content
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  @javascript
  Scenario: Commission landing page content is correctly imported
    When I am on the homepage
    And I click "English"

    Then the site switcher link "Commission and its priorities" is active
    But the site switcher link "Policies, information and services" is not active

    And I should see the heading "The European Commission's priorities" in the "content" region
    And I should see the following links in the "content" region:
      | Jobs, growth and investment                                       |
      | Digital single market                                             |
      | Energy union and climate                                          |
      | Internal market                                                   |
      | A deeper and fairer economic and monetary union                   |
      | A balanced and progressive trade policy to harness globalisation  |
      | Justice and fundamental rights                                    |
      | Migration                                                         |
      | A stronger global actor                                           |
      | Democratic change                                                 |
    And I should see the link "More about the priorities" in the "content" region

    When I open the language switcher dialog
    And I click "Français" in the "language switcher"

    Then I should see the heading "Les priorités de la Commission européenne" in the "content" region
    And I should see the following links in the "content" region:
      | Emploi, croissance et investissement                                                |
      | Marché unique numérique                                                             |
      | Union de l'énergie et climat                                                        |
      | Marché intérieur                                                                    |
      | Une Union économique et monétaire plus approfondie et plus équitable                |
      | Une politique commerciale équilibrée et novatrice pour maîtriser la mondialisation  |
      | Justice et droits fondamentaux                                                      |
      | Migration                                                                           |
      | Une Europe plus forte sur la scène internationale                                   |
      | Changement démocratique                                                             |
    And I should see the link "En savoir plus sur les priorités" in the "content" region

  @javascript
  Scenario: Priorities landing page content is correctly imported
    When I am on the homepage
    And I click "English"

    When I click "Policies, information and services"
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

    When I open the language switcher dialog
    And I click "Français" in the "language switcher"

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
