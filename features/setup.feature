@api
Feature: Setup
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the demo site is correctly setup.

  Scenario: The demo site is installed
    When I am on the homepage
    Then I should see "Europa Demo"

  Scenario: The demo blocks are correctly displayed
    When I am on "the front page"
    Then I should see the "sites switcher" element in the "header"
    And I should see the "search box" element in the "header"
    And I should see the "language switcher" element in the "header"
    And I should see the "banner title" element in the "banner"
    And I should see the "corporate top block" element in the "corporate top footer"
    And I should see the "corporate bottom block" element in the "corporate bottom footer"
