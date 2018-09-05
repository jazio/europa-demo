@sites-all
Feature: Setup
  In order to make sure that the project is correctly set up
  As a developer
  I need to make sure that we can visit all three sites

  Scenario Outline:
    Given I am on "/sites/<path>/web"
    Then I should see "<name>"

    Examples:
    | path   | name        |
    | rtd    | Site RTD    |
    | agri   | Site AGRI   |
    | energy | Site ENERGY |
