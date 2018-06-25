@api @authentication
Feature: Login through ECAS authentication service
  In order to be able to access the site backend
  As an editor
  I need to login through ECAS authentication service

  Scenario: As an editor I want to login via ECAS and create and translate a page
    When I am on "the login page"

    # Redirecting to the authentication mock service.
    And I fill in "User" with "John Smith"
    And I fill in "Nickname" with "The editor"
    And I fill in "Password" with "john"
    And I press the "Submit" button

    # Redirected back to the site.
    Then I click "My account"
    And I should see text matching "John Smith"

    # Then I am logged in as a user with the "authenticated user" role
    # Create a Landing page content.
    When I am on "the create Landing page"
    And I fill in "Title" with "Homepage"
    And I fill in "Introduction" with "This is the home page of the site"
    And I press "Save"

    Then I should see the following success messages:
      | Landing page Homepage has been created. |
    And I should see "Homepage" in the "page header"
    And I should see "This is the home page of the site" in the "page header"

    # Translate the Landing page content into Spanish.
    When I click "Translate"
    And I click "Add" in the "Spanish" row
    And I fill in "Título" with "Página principal"
    And I fill in "Introduction" with "Esta es la página principal del sitio"
    And I press "Guardar (this translation)"

    Then I should see the following success messages:
      | Landing page Página principal ha sido actualizado. |
    And I should see "Página principal" in the "page header"
    And I should see "Esta es la página principal del sitio" in the "page header"

    When I am on "the logout page"
    Then I should not see the link "My account"
