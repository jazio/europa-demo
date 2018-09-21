<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Drupal\DrupalExtension\Context\RawDrupalContext;

/**
 * Class AuthenticationContext.
 */
class AuthenticationContext extends RawDrupalContext {

  /**
   * Creates and authenticates a user with the given role(s) in EU Login.
   *
   * @Given I am logged in in EU Login as a user with the :role role(s)
   * @Given I am logged in in EU Login as a/an :role
   */
  public function assertAuthenticatedByRole($role) {
    // Check if a user with this role is already logged in.
    if (!$this->loggedInWithRole($role)) {
      // Create user (and project)
      $user = (object) array(
        'name' => $this->getRandom()->name(8),
        'pass' => $this->getRandom()->name(16),
        'role' => $role,
      );
      $user->mail = "{$user->name}@example.com";
      $user = $this->userCreate($user);

      // Once the user is created assign the CAS username for the account.
      $cas_user_manager = \Drupal::service('cas.user_manager');
      $account = user_load($user->uid);
      $cas_user_manager->setCasUsernameForAccount($account, $user->name);

      $roles = explode(',', $role);
      $roles = array_map('trim', $roles);
      foreach ($roles as $role) {
        if (!in_array(strtolower($role), array('authenticated', 'authenticated user'))) {
          // Only add roles other than 'authenticated user'.
          $this->getDriver()->userAddRole($user, $role);
        }
      }

      // Login.
      $this->login($user);
    }
  }

}
