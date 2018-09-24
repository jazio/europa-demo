<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Mink-based context that allows to visit pages on all demo sites.
 */
class SitesMinkContext extends RawMinkContext {

  /**
   * Sites configuration, each item contains "name" and "base_url".
   *
   * @var array
   */
  protected $sites = [];

  /**
   * SitesMinkContext constructor.
   */
  public function __construct(array $sites) {
    $this->sites = $sites;
  }

  /**
   * Visit page on given site.
   *
   * @Given I am on :page page of the :site site
   */
  public function visitOnSite(string $page, string $site): void {
    $this->setMinkParameter('base_url', $this->sites[$site]['base_url']);
    $this->visitPath($page);
  }

  /**
   * Assert that user is on given site.
   *
   * @Then I should be on the :site site
   */
  public function assertSite(string $site): void {
    // Assert being on given site by comparing current and site's URL.
    $site_path = parse_url($this->sites[$site]['base_url'])['path'];
    $current_path = parse_url($this->getSession()->getCurrentUrl())['path'];
    if (strpos($current_path, $site_path) !== 0) {
      throw new \Exception("Current page '{$current_path}' does not belong to the '{$site}' site");
    }

    // Make sure that the site displays the site ribbon.
    $this->assertSession()->elementContains('css', '.europa-demo-ribbon__content', $this->sites[$site]['name']);
  }

}
