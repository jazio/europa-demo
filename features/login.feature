@api
Feature: Login through OE Auth
  In order to be able to access the CMS backend
  As user of the system
  I need to login through OE Auth

  Scenario: Login
    When I am on "the login page"
    # We are redirected to the mock OE Auth server at this point.
    And I fill in "User" with "Dr. Lektroluv"
    And I fill in "Nickname" with "The Man with the Green Mask"
    And I fill in "Password" with "Em0lotion"
    And I press the "Submit" button
    # Redirected back to Drupal.
    Then I click "My account"
    And I should see text matching "Dr. Lektroluv"

    When I am on "the logout page"
    Then I should not see the link "My account"
