@api @selection-page
Feature: Language selection
  In order to be able choose the initial language of the site
  As a visitor
  I want to be presented with a language selection page

  Background:
    Given the following "Landing page" content item:
      | Title         | Test page   |
      | Introduction  | Hello world |
    And the following "French" translation for the "Landing page" with title "Test page":
      | Title         | Page de test     |
      | Introduction  | Bonjour le monde |
    And the following "Spanish" translation for the "Landing page" with title "Test page":
      | Title         | Página de prueba |
      | Introduction  | Hola Mundo       |

  Scenario: When I visit the homepage I'm presented with a language selection page

    Given I am on the homepage
    Then I should be redirected to the language selection page

    When I click "français"
    Then the url should match "/fr"

  Scenario: Users visiting a page should be presented with the language selection page,
            if no language is detected in the URL.

    Given I visit the "Test page" content
    Then I should be redirected to the language selection page

    When I click "français"
    Then the url should match "/fr/page-de-test"
