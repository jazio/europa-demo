@api @flush-cache
Feature: Webtools Analytics
  In order to track visits on the site
  As a site owner
  I want to make sure that the OpenEuropa Webtools Analytics module is enabled and correctly set up.

  @setup-webtools-analytics
  Scenario: Make sure that the Webtools Analytics script is embedded into the page correctly
    When I am on "the front page"
    Then the page should contain the Piwik script

    When I go to "the non-existing page"
    Then the page should contain the Piwik script
    Then the Piwik script should detect a "non-existing" page

    When I go to "the administrative page"
    Then the page should contain the Piwik script
    Then the Piwik script should detect a "administrative" page
