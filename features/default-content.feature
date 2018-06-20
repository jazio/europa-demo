@api
Feature: Default content
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  @javascript
  Scenario: All default content is correctly imported
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

