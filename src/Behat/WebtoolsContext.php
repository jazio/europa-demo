<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Behat\Behat\Hook\Scope\BeforeFeatureScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Drupal\DrupalExtension\Context\ConfigContext;

/**
 * Webtools Analytics configuration context.
 */
class WebtoolsContext extends ConfigContext {

  /**
   * WebTools Analytics configuration name.
   */
  private const CONFIG_NAME = 'oe_webtools_analytics.settings';

  /**
   * The site unique identifier.
   */
  private const SITE_ID = 'siteID';

  /**
   * The site path.
   */
  private const SITE_PATH = 'sitePath';

  /**
   * Site ID test value.
   *
   * @var string
   */
  private $siteId = '123';

  /**
   * Site path test value.
   *
   * @var string
   */
  private $sitePath = 'ec.europa.eu';

  /**
   * Check whereas the Piwik Script is present on the page.
   *
   * @Then the page should contain the Piwik script
   */
  public function assertAnalyticsScriptOnPage(): void {
    $piwikScript = sprintf(
      '/<script type="application\/json">{"utility":"piwik","%s":"%s","%s":\["%s"\]((,"is40(3|4)":true)|)}<\/script>/',
      self::SITE_ID,
      $this->siteId,
      self::SITE_PATH,
      $this->sitePath
    );

    if (!preg_match($piwikScript, $this->getSession()->getPage()->getContent())) {
      throw new \Exception('The Piwik script was not found anywhere in the HTML response of the current page.');
    }
  }

  /**
   * Assert Piwik HTTP response detection.
   *
   * @Then the Piwik script should detect a :type page
   */
  public function assertPiwikExtraParams($type): void {
    switch ($type) {
      case 'non-existing':
        $code = '404';
        break;

      case 'administrative':
        $code = '403';
        break;
    }

    $piwikScript = sprintf('/<script type="application\/json">{"utility":"piwik",(.*),"is%s":true}<\/script>/', $code);

    if (!preg_match($piwikScript, $this->getSession()->getPage()->getContent())) {
      throw new \Exception(sprintf('The Piwik script doesn\'t detect the %s page.', $type));
    }
  }

  /**
   * Flush all caches before running tagged features.
   *
   * @param \Behat\Behat\Hook\Scope\BeforeFeatureScope $scope
   *   The Hook scope.
   *
   * @BeforeFeature @flush-cache
   */
  public static function flushCache(BeforeFeatureScope $scope): void {
    drupal_flush_all_caches();
  }

  /**
   * Setup the Webtools Analytics test configuration.
   *
   * @param \Behat\Behat\Hook\Scope\BeforeScenarioScope $scope
   *   The Hook scope.
   *
   * @BeforeScenario @setup-webtools-analytics
   */
  public function setupWebtoolsAnalytics(BeforeScenarioScope $scope): void {
    $this->setBasicConfig(self::CONFIG_NAME, self::SITE_ID, $this->siteId);
    $this->setBasicConfig(self::CONFIG_NAME, self::SITE_PATH, $this->sitePath);
  }

}
