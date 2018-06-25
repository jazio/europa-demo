<?php

declare(strict_types = 1);

namespace Drupal\Tests\oe_multilingual\Behat;

use Behat\Behat\Hook\Scope\AfterFeatureScope;
use Behat\Behat\Hook\Scope\BeforeFeatureScope;
use Drupal\DrupalExtension\Context\RawDrupalContext;

/**
 * Class DrupalContext.
 */
class AuthenticationContext extends RawDrupalContext {

  /**
   * Enable OpenEuropa Multilingual Selection Page module.
   *
   * @param \Behat\Behat\Hook\Scope\BeforeFeatureScope $scope
   *   The Hook scope.
   *
   * @BeforeFeature @authentication
   */
  public function setupSelectionPage(BeforeFeatureScope $scope): void {
    \Drupal::service('module_installer')->install(['oe_auth']);
  }

  /**
   * Disable OpenEuropa Multilingual Selection Page module.
   *
   * @param \Behat\Behat\Hook\Scope\AfterFeatureScope $scope
   *   The Hook scope.
   *
   * @AfterFeature @authentication
   */
  public function revertSelectionPage(AfterFeatureScope $scope): void {
    \Drupal::service('module_installer')->uninstall(['oe_auth']);
  }

}
