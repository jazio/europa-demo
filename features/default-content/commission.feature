@api @site-agri @site-energy @site-rtd
Feature: Default content 'Commission and its priorities'
  In order to be able to showcase the site's features
  As a developer
  I want to make sure that the exported default content is correctly imported

  Scenario: Commission landing page content is correctly imported
    When I am on the homepage
    And I click "English"

    Then the site switcher link "Commission and its priorities" is active
    But the site switcher link "Policies, information and services" is not active

    And I should see the heading "The European Commission's priorities" in the "content" region
    And I should see the following links in the "content" region:
      | Jobs, growth and investment                                       |
      | Digital single market                                             |
      | Energy union and climate                                          |
      | Internal market                                                   |
      | A deeper and fairer economic and monetary union                   |
      | A balanced and progressive trade policy to harness globalisation  |
      | Justice and fundamental rights                                    |
      | Migration                                                         |
      | A stronger global actor                                           |
      | Democratic change                                                 |
    And I should see the link "More about the priorities" in the "content" region

    And I should see the following links in the "content" region:
      | President Juncker                                                 |
      | The Commissioners                                                 |

    And I should see the following links in the "content" region:
      | Departments (Directorates-General) and services                   |
      | Commission at work                                                |
    And I should see the link "More about the Commission" in the "content" region

    And I should see the following links in the "content" region:
      | EU local offices and information points                           |
      | Commission staff                                                  |
      | Contact guide by Commission activity                              |
      | Press services                                                    |

    And I should see the following links in the "content" region:
      | European Cultural Heritage Summit                                 |
      | Preparation of the upcoming European Council                      |
      | EU and Australia launch talks for a broad trade agreement         |
    And I should see the link "All news" in the "content" region

    And I should see the following links in the "content" region:
      | EU budget for the future                                          |
      | Brexit                                                            |
      | Consultation on the Future of Europe                              |

    When I open the language switcher dialog
    And I click "français" in the "language switcher"

    Then I should see the heading "Les priorités de la Commission européenne" in the "content" region
    And I should see the following links in the "content" region:
      | Emploi, croissance et investissement                                                |
      | Marché unique numérique                                                             |
      | Union de l'énergie et climat                                                        |
      | Marché intérieur                                                                    |
      | Une Union économique et monétaire plus approfondie et plus équitable                |
      | Une politique commerciale équilibrée et novatrice pour maîtriser la mondialisation  |
      | Justice et droits fondamentaux                                                      |
      | Migration                                                                           |
      | Une Europe plus forte sur la scène internationale                                   |
      | Changement démocratique                                                             |
    And I should see the link "En savoir plus sur les priorités" in the "content" region

    And I should see the following links in the "content" region:
      | Le président Juncker                                              |
      | Les commissaires                                                  |

    And I should see the following links in the "content" region:
      | Directions générales et services                                  |
      | La Commission au travail                                          |
    And I should see the link "En savoir plus sur la Commission" in the "content" region

    And I should see the following links in the "content" region:
      | Bureaux locaux et centres d'information de l'UE                   |
      | Personnel de la Commission                                        |
      | Annuaire de la Commission par activité                            |
      | Services de presse                                                |

    And I should see the following links in the "content" region:
      | Sommet européen du patrimoine culturel                                            |
      | Préparation du prochain Conseil européen                                          |
      | L’UE et l’Australie entament des négociations en vue d’un vaste accord commercial |
    And I should see the link "Toute l'actualité" in the "content" region

    And I should see the following links in the "content" region:
      | Un budget de l’UE pour l’avenir                                   |
      | Brexit                                                            |
      | Consultation sur l’avenir de l’Europe                             |

    When I open the language switcher dialog
    And I click "italiano" in the "language switcher"

    Then I should see the heading "Le priorità della Commissione europea" in the "content" region
    And I should see the following links in the "content" region:
      | Occupazione, crescita e investimenti                                                |
      | Mercato unico digitale                                                              |
      | Unione dell'energia e clima                                                         |
      | Mercato interno                                                                     |
      | Un'Unione economica e monetaria più profonda e più equa                             |
      | Una politica commerciale equilibrata e innovativa per gestire la globalizzazione    |
      | Giustizia e diritti fondamentali                                                    |
      | Le migrazioni                                                                       |
      | Un ruolo più incisivo a livello mondiale                                            |
      | Cambiamento democratico                                                             |
    And I should see the link "Per saperne di più sulle priorità" in the "content" region

    And I should see the following links in the "content" region:
      | Il presidente Juncker                                             |
      | I commissari                                                      |

    And I should see the following links in the "content" region:
      | Direzioni generali e servizi                                      |
      | La Commissione al lavoro                                          |
    And I should see the link "Per saperne di più sulla Commissione" in the "content" region

    And I should see the following links in the "content" region:
      | Rappresentanze locali dell'UE ed eurosportelli    |
      | Il personale della Commissione                    |
      | Guida di contatto per attività della Commissione  |
      | Contatti con la stampa                            |

    And I should see the following links in the "content" region:
      | European Cultural Heritage Summit                                 |
      | Preparation of the upcoming European Council                      |
      | EU and Australia launch talks for a broad trade agreement         |
    And I should see the link "Tutta l’attualità" in the "content" region

    And I should see the following links in the "content" region:
      | Il bilancio UE per il futuro          |
      | Brexit                                |
      | Consultazione sul futuro dell’Europa  |
