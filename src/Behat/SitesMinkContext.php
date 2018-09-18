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

}
