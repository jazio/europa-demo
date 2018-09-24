<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat\Services\Driver\Cores;

use Drupal\Driver\Cores\Drupal8 as OriginalDrupal8;

/**
 * Overrides Drupal 8 core driver to account for CAS integration.
 */
class Drupal8 extends OriginalDrupal8 {

  /**
   * {@inheritdoc}
   */
  public function userCreate(\stdClass $user): void {
    parent::userCreate($user);

    if ($user->uid !== NULL) {
      // Once the user is created assign the CAS username for the account.
      $cas_user_manager = \Drupal::service('cas.user_manager');
      $account = user_load($user->uid);
      $cas_user_manager->setCasUsernameForAccount($account, $user->name);
    }
  }

}
