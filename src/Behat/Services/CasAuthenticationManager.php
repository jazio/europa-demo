<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat\Services;

use Drupal\DrupalExtension\Manager\DrupalAuthenticationManager;

/**
 * Authenticate on CAS test server.
 */
class CasAuthenticationManager extends DrupalAuthenticationManager {

  /**
   * {@inheritdoc}
   */
  public function logIn(\stdClass $user): void {
    // Ensure we aren't already logged in.
    $this->fastLogout();

    $this->getSession()->visit($this->locatePath('/user'));
    $element = $this->getSession()->getPage();

    $element->fillField("User", $user->name);
    $element->fillField("Nickname", $user->name);
    $element->fillField("Password", $user->pass);
    $submit = $element->findButton("Submit");
    if (empty($submit)) {
      throw new \Exception(sprintf("No submit button at %s", $this->getSession()->getCurrentUrl()));
    }

    // Log in.
    $submit->click();

    if (!$this->loggedIn()) {
      if (isset($user->role)) {
        throw new \Exception(sprintf("Unable to determine if logged in because 'log_out' link cannot be found for user '%s' with role '%s'", $user->name, $user->role));
      }
      else {
        throw new \Exception(sprintf("Unable to determine if logged in because 'log_out' link cannot be found for user '%s'", $user->name));
      }
    }

    $this->userManager->setCurrentUser($user);
  }

}
