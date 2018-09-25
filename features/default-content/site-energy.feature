@api @site-energy
Feature: Default content for ENERGY site
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  Scenario: ENERGY homepage is correctly imported
    When I am on "the front page"

    Then I should see the heading "Directorate-General for Energy" in the "page header" region

    And I should see the following links in the "navigation":
      | Home            |
      | Data & Analysis |
      | Consultations   |
      | News            |
      | Events          |
      | Funding         |
      | Studies         |
      | Publications    |
      | About Us        |

    And I should see the following links in the "content":
      | Vice-President Šefčovič and Commissioner Arias Cañete to attend 10th Citizens' Energy Forum                 |
      | Synchronisation of the Baltic States' electricity grid with the continental European system                 |
      | Michael R. Bloomberg partners with Commissioner Arias Cañete to support European transition from coal power |
      | New lightbulb rules will enable household energy savings and help reduce greenhouse gas emissions           |
      | State aid: Commission approves three support measures for renewable energy in Denmark                       |

  Scenario Outline: News and events pages are correctly linked on the main navigation menu
    When I am on "the front page"

    And I click "<link>" in the "navigation"
    Then I should see the heading "<heading>" in the "page header" region

    Examples:
      | link   | heading |
      | News   | News    |
      | Events | Events  |
