<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Custom context to handle tests of RDF entities from outside Drupal.
 */
class RdfExternalContext extends RawMinkContext {

  /**
   * A mapping of RDF entity paths to titles.
   *
   * @var array
   */
  protected $pathMappings;

  /**
   * RdfExternalContext constructor.
   *
   * @param array $path_mappings
   *   A map of paths and RDF entity titles.
   */
  public function __construct(array $path_mappings = []) {
    $this->pathMappings = $path_mappings;
  }

  /**
   * Navigate to the canonical URL of a given RDF entity.
   *
   * @When I go to the RDF entity page :title on the :site site
   */
  public function iGoToTheRdfEntityPage(string $title, string $site): void {
    if (!isset($this->pathMappings[$title])) {
      throw new \Exception('RDF entity not found in the path mappings.');
    }

    $this->visitPath("sites/$site/web/en/rdf_entity/" . $this->pathMappings[$title]);
  }

  /**
   * Asserts that a String is found in a region.
   *
   * @Then I should see the :text in (the ):element( region)
   */
  public function assertTitleInCorrectRegion(string $text, string $element): void {
    $this->assertSession()->elementTextContains('css', $element, $text);
  }

}
