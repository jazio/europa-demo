@api @site-inea
Feature: Default content for INEA site
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  Scenario: INEA homepage is correctly imported
    When I am on "the front page"

    Then I should see the heading "Innovation and Networks Executive Agency" in the "page header" region

    And I should see the following links in the "navigation":
      | Home                        |
      | Connecting Europe facility  |
      | Horizon 2020                |
      | Ten-T                       |
      | Marco Polo                  |
      | News                        |
      | Events                      |
      | About Us                    |

    And I should see "The Innovation and Networks Executive Agency (INEA) is the successor of the Trans-European Transport Network Executive Agency (TEN-T EA)" in the "content"

  Scenario Outline: News and events pages are correctly linked on the main navigation menu
    When I am on "the front page"

    And I click "<link>" in the "navigation"
    Then I should see the heading "<heading>" in the "page header" region

    Examples:
      | link   | heading |
      | News   | News    |
      | Events | Events  |
