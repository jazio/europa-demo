@api
Feature: Translation
  In order to be able to appreciate the showcase of the site's features
  As a visitor
  I want to make sure that the demo site is correctly translated.


Scenario: Visitors can see interface translated correctly in french
  Given I am on the homepage
  When I click "Français"
  Then the url should match "/fr"
  And I should see the link "La Commission et ses priorités" in the "header" region
  And I should see the link "Politiques, informations et services" in the "header" region
  And I should see "Recherche" in the "header" region
  And I should see "Commission européenne" in the "corporate top footer" region
  And I should see the link "La Commission et ses priorités" in the "corporate top footer" region
  And I should see the link "Politiques, informations et services" in the "corporate top footer" region
  And I should see "Suivre la Commission européenne" in the "corporate top footer" region
  And I should see "Union européenne" in the "corporate top footer" region
  And I should see the link "Institutions de l’UE" in the "corporate top footer" region
  And I should see the link "À propos de la nouvelle présence de la Commission sur le web" in the "corporate bottom footer" region
  And I should see the link "Ressources pour les partenaires" in the "corporate bottom footer" region
  And I should see the link "Avis juridique" in the "corporate bottom footer" region
  And I should see the link "Contact" in the "corporate bottom footer" region
  And I should see the link "L'avenir de l'Europe" in the "banner" region
  And I should see "À LA UNE" in the "banner" region
  
Scenario: Visitors can see interface translated correctly in italian
  Given I am on the homepage
  When I click "Italiano"
  Then the url should match "/it"
  And I should see the link "Le priorità della Commissione" in the "header" region
  And I should see the link "Politiche, informazioni e servizi" in the "header" region
  And I should see "Cerca" in the "header" region
  And I should see "Commissione europea" in the "corporate top footer" region
  And I should see the link "Le priorità della Commissione" in the "corporate top footer" region
  And I should see the link "Politiche, informazioni e servizi" in the "corporate top footer" region
  And I should see "Segui la Commissione europea" in the "corporate top footer" region
  And I should see "Unione europea" in the "corporate top footer" region
  And I should see the link "Istituzioni dell'UE" in the "corporate top footer" region
  And I should see the link "La nuova presenza online della Commissione" in the "corporate bottom footer" region
  And I should see the link "Resources for partners" in the "corporate bottom footer" region
  And I should see the link "Note legali" in the "corporate bottom footer" region
  And I should see the link "Contatti" in the "corporate bottom footer" region
  And I should see the link "Il futuro dell'Europa" in the "banner" region
  And I should see "IN PRIMO PIANO" in the "banner" region