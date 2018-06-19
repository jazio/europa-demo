<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Behat\Behat\Hook\Scope\BeforeFeatureScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Drupal\DrupalExtension\Context\ConfigContext;

/**
 * Context for configuring the WebtoolsContext.
 */
class WebtoolsContext extends ConfigContext {

  /**
   * The Webtools analytics entrance in settings.php.
   */
  private const CONFIG_NAME = 'oe_webtools_analytics.settings';

  /**
   * The site unique identifier.
   */
  private const SITE_ID = 'siteID';

  /**
   * The site unique identifier.
   */
  private const SITE_PATH = 'sitePath';

  /**
   * The value configuration of oe_webtools_analytics.settings['siteID'].
   *
   * @var string
   */
  private $siteId = '123';

  /**
   * The value configuration of oe_webtools_analytics.settings['sitePath'].
   *
   * @var string
   */
  private $sitePath = 'ec.europa.eu';

  /**
   * Check if the Piwik Script is present in the page.
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
   * Check if the Piwik detect a type of the current page.
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
   * Setup the Webtools Analytics module.
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
