@api
Feature: Setup
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the demo site is correctly setup.

  Scenario: The demo site is installed
    When I am on the homepage
    Then I should see "Europa Demo"
