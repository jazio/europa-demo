@sites-all
Feature: Setup
  In order to make sure that the project is correctly set up
  As a developer
  I need to make sure that we can visit all three sites

  Scenario Outline:
    When I am on "the front page" page of the "<name>" site
    Then I should see "<name>"

    Examples:
    | name    |
    | info    |
    | inea    |
    | energy  |
