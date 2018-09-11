@api @site-inea @site-energy @site-info
Feature: Content language selector
  When I'm viewing a content item not available in the current site language
  I'm given the possibility of choosing another language for it
  while the content is displayed by default in its default language
  i.e.: the language in which the content has been inserted

  Background:
    Given the following "Landing page" content item:
      | Title         | Page title |
      | Introduction  | Page body  |
    And the following "Italian" translation for the "Landing page" with title "Page title":
      | Title         | Titolo pagina |
      | Introduction  | Testo pagina  |
    And the following "Greek" translation for the "Landing page" with title "Page title":
      | Title         | Τίτλος σελίδας  |
      | Introduction  | Σελίδα κειμένου |
    And the following "Spanish" translation for the "Landing page" with title "Page title":
      | Title         | Título de página  |
      | Introduction  | Texto de página   |

  Scenario: Visitor navigating to an available translation shouldn't see the language selector
    Given I am on "/en/page-title"
    Then I should see "Page title" in the "page header"
    And I should see "Page body"
    And I should not see the link "Spanish" in the "page header" region

  Scenario: Visitor navigating to an unavailable translation should see the language selector
    Given I am on "/en/page-title"
    Then I should see "Page title" in the "page header"
    And I should see "Page body"
    When I click "български"
    Then I should see "Page title" in the "page header"
    And I should see "Page body"
    And I should see the link "español" in the "page header"
