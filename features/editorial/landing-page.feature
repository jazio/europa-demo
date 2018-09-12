@api @site-inea @site-energy @site-info
Feature: Landing page
  In order to be able to showcase the site's features
  As a content editor
  I want to make sure that I can create landing pages that contain fully functional page headers.

  Scenario: I can create and translate a Landing page content
    Given I am logged in as a user with the "authenticated user" role
    # Create a Landing page content.
    When I am on "the create Landing page"
    And I fill in "Title" with "Homepage"
    And I fill in "Introduction" with "This is the home page of the site"
    And I press the "Add Rich text" button
    And I fill in "Text" with "This is the content of the page."
    And I press "Save"
    Then I should see the success message "Landing page Homepage has been created."
    And I should see "Homepage" in the "page header"
    And I should see "This is the home page of the site" in the "page header"
    And I should see "This is the content of the page." in the "content"

    # Translate the Landing page content into French.
    When I click "Translate"
    And I click "Add" in the "French" row
    And I fill in "Title" with "Page principale"
    And I fill in "Introduction" with "Ceci est la page principale du site"
    And I fill in "Text" with "Ceci est le contenu de la page."
    And I press "Save (this translation)"
    Then I should see the success message "Landing page Page principale has been updated."
    And I should see "Page principale" in the "page header"
    And I should see "Ceci est la page principale du site" in the "page header"
    And I should see "Ceci est le contenu de la page." in the "content"
