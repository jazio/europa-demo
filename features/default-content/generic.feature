@api
Feature: Default content
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  Scenario: Landing pages should have meaningful URL aliases
    When I am on the homepage
    And I click "English"

    When I click "Policies, information and services"
    Then I should be on "/en/info"

    And I click "Commission and its priorities"
    Then I should be on "/en/commission"

    When I open the language switcher dialog
    And I click "français" in the "language switcher"

    When I click "Politiques, informations et services"
    Then I should be on "/fr/info"

    And I click "La Commission et ses priorités"
    Then I should be on "/fr/commission"

  Scenario: Content pages should have meaningful URL aliases
    Given I am on the homepage
    And I click "English"

    And I click "Commission and its priorities"
    Then I should be on "/en/commission"
    
    When I click "More about the priorities"
    Then I should be on "/en/commission/priorities"
    
    When I click "Jobs, growth and investment"
    Then I should be on "/en/commission/priorities/jobs-growth-and-investment"

  Scenario: HTML characters are encoded correctly
    Given I am on the homepage
    When I click "français"
    And I click "Politiques, informations et services"
    Then I should see "Économie de l'UE, euro et informations pratiques pour les entreprises et les entrepreneurs de l'UE."
