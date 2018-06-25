<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Drupal\DrupalExtension\Context\RawDrupalContext;

/**
 * Class DrupalContext.
 */
class AuthenticationContext extends RawDrupalContext {

  /**
   * Enable OpenEuropa Authentication module.
   *
   * @param \Behat\Behat\Hook\Scope\BeforeScenarioScope $scope
   *   The Hook scope.
   *
   * @throws \Exception
   *
   * @BeforeScenario @authentication
   */
  public function enableAuthentication(BeforeScenarioScope $scope): void {
    if (!\Drupal::service('module_installer')->install(['oe_auth'])) {
      throw new \Exception('Enabling OpenEuropa Authentication module fails.');
    }
  }

  /**
   * Disable OpenEuropa Authentication module.
   *
   * @param \Behat\Behat\Hook\Scope\AfterScenarioScope $scope
   *   The Hook scope.
   *
   * @AfterScenario @authentication
   */
  public function disableAuthentication(AfterScenarioScope $scope): void {
    if (!\Drupal::service('module_installer')->uninstall(['oe_auth'])) {
      throw new \Exception('Disabling OpenEuropa Authentication module fails.');
    }
  }

}
