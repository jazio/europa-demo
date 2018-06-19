@api
Feature: Landing page
  In order to be able to showcase the site's features
  As a content editor
  I want to make sure that I can create landing pages that contain fully functional page headers.

  Scenario: I can create and translate a landing page content
    When I am logged in as a user with the "authenticated user" role
    When I am at "node/add/landing_page"
    And I fill in "Title" with "Homepage"
    And I fill in "Introduction" with "This is the home page of the site"
    And I press "Save"
    Then I should see "Homepage" in the "page header"
    And I should see "This is the home page of the site" in the "page header"
    When I click "Translate"
    And I click "Add" in the "Spanish" row
    And I fill in "Título" with "Página principal"
    And I fill in "Introduction" with "Esta es la página principal del sitio"
    And I press "Guardar (this translation)"
    Then I should see "Página principal" in the "page header"
    And I should see "Esta es la página principal del sitio" in the "page header"