@sites-all
Feature: Setup
  In order to make sure that the project is correctly set up
  As a developer
  I need to make sure that we can visit all three sites

  Scenario Outline:
    When I am on "/sites/<path>/web"
    Then I should see "<name>"

    Examples:
    | path   | name        |
    | info   | Site INFO   |
    | inea   | Site INEA   |
    | energy | Site ENERGY |
