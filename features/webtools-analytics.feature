@api @webtools-analytics
Feature: Webtools Analytics
  In order to check if the type attribute is set for the Piwik element.
  As an anonymous
  I want to check Piwik is available.

  Background:
    Given I set the configuration item "oe_webtools_analytics.settings" with key "siteID" to "123"
    And I set the configuration item "oe_webtools_analytics.settings" with key "sitePath" to "ec.europa.eu"

  Scenario Outline: Check if the PIWIK script is embedded into the page correctly
    Given I go to "<path>"
    Then the response status code should be <status_code>
    Then the response should contain the Piwik script for a page <status_code> with the siteId "123" and the sitePath "ec.europa.eu"

    Examples:
    | path      | status_code |
    | en        | 200         |
    | falsepage | 404         |
    | admin     | 403         |
