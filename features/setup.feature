Feature: Setup
  In order to make sure that the project is correctly set up
  As a developer
  I need to make sure that we can visit all three sites

  Scenario Outline:
    Given I am on "/<path>/web"
    Then I should see "<name>"

    Examples:
    | path   | name   |
    | site-rtd | Site A |
    | site-agri | Site B |
    | site-energy | Site C |
