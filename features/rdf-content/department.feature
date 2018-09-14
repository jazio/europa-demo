@sites-all
Feature: Departments
  In order to be able to showcase the departments
  As an Anonymous user
  I want to make sure that departments can be correctly accessed and seen

  Scenario Outline: Departments should visible on the Info site
    Given I go to the RDF entity page "<title>" on the "<site>" site
    Then I should see the "<title>" in the title region

    Examples:
      | title                                    | site |
      | Directorate-General for Environment      | info |
      | Innovation and Networks Executive Agency | info |
      | Directorate-General for Energy           | info |

  Scenario Outline: Departments should no be visible on the INEA or Energy sites
    Given I go to the RDF entity page "<title>" on the "<site>" site
    Then I should see the "Access denied" in the title region

    Examples:
      | title                                    | site |
      | Directorate-General for Environment      | inea |
      | Innovation and Networks Executive Agency | inea |
      | Directorate-General for Energy           | inea |
      | Directorate-General for Environment      | energy |
      | Innovation and Networks Executive Agency | energy |
      | Directorate-General for Energy           | energy |