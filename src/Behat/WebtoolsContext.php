<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Behat\Behat\Hook\Scope\BeforeFeatureScope;
use Drupal\DrupalExtension\Context\RawDrupalContext;

/**
 * Context for configuring the WebtoolsContext.
 */
class WebtoolsContext extends RawDrupalContext {

  /**
   * Check if the Piwik Script is present in the page.
   *
   * @Then the response should contain the Piwik script for a page :arg3 with the siteId :arg1 and the sitePath :arg2
   */
  public function theResponseShouldContainThePiwikScriptForPageWithTheSiteidAndTheSitepath($arg1, $arg2, $arg3) {
    $params = "";
    switch ($arg3) {
      case 404:
        $params = ",\"is404\":true";
        break;

      case 403:
        $params = ",\"is403\":true";
        break;
    }

    $text = sprintf("<script type=\"application/json\">{\"utility\":\"piwik\",\"siteID\":\"%s\",\"sitePath\":[\"%s\"]%s}</script>", $arg1, $arg2, $params);

    if (stripos($this->getSession()->getPage()->getContent(), $text) === FALSE) {
      throw new \Exception('The correct Piwik script was not found anywhere in the HTML response of the current page.');
    }
  }

  /**
   * Flush all caches before to run the feature.
   *
   * @param \Behat\Behat\Hook\Scope\BeforeFeatureScope $scope
   *   The Hook scope.
   *
   * @BeforeFeature @webtools-analytics
   */
  public static function removeCache(BeforeFeatureScope $scope): void {
    drupal_flush_all_caches();
  }

}
