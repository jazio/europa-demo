<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Behat\Mink\Element\NodeElement;
use Drupal\DrupalExtension\Context\MinkContext as DrupalExtensionMinkContext;
use Behat\Gherkin\Node\TableNode;

/**
 * Class DrupalMinkContext.
 */
class DrupalMinkContext extends DrupalExtensionMinkContext {

  /**
   * Assert that visitor is redirected to language selection page.
   *
   * @Then I should be redirected to the language selection page
   */
  public function assertLanguageSelectionPageRedirect() {
    $this->assertSession()->addressMatches("/.*\/select-language/");
  }

  /**
   * Assert links in region.
   *
   * @param string $region
   *   Region name.
   * @param \Behat\Gherkin\Node\TableNode $links
   *   List of links.
   *
   * @throws \Exception
   *
   * @Then I should see the following links in (the ):region( region):
   */
  public function assertLinksInRegion($region, TableNode $links): void {
    $region_object = $this->getSession()->getPage()->find('region', $region);

    foreach ($links->getRows() as $row) {
      $result = $region_object->findLink($row[0]);
      if (empty($result)) {
        throw new \Exception(sprintf('No link to "%s" in the "%s" region on the page %s', $row[0], $region, $this->getSession()->getCurrentUrl()));
      }
    }
  }

  /**
   * Open language switcher dialog.
   *
   * @When I open the language switcher dialog
   */
  public function openLanguageSwitcher(): void {
    $this->getRegion('header')
      ->find('css', '.ecl-lang-select-sites__link')
      ->click();
  }

  /**
   * Assert that given site switcher link is active.
   *
   * @Then the site switcher link :arg1 is active
   */
  public function assertActiveSiteSwitcherLink($label): void {
    $element = $this->getSiteSwitcherLink($label);
    if (!$element->hasClass('ecl-site-switcher__option--is-selected')) {
      throw new \RuntimeException("Site switcher link with label '{$label}' is not active but it should be");
    }
  }

  /**
   * Assert that given site switcher link is not active.
   *
   * @Then the site switcher link :arg1 is not active
   */
  public function assertNotActiveSiteSwitcherLink($label): void {
    $element = $this->getSiteSwitcherLink($label);
    if ($element->hasClass('ecl-site-switcher__option--is-selected')) {
      throw new \RuntimeException("Site switcher link with label '{$label}' is active but it should not be");
    }
  }

  /**
   * Get site switcher link given its label.
   *
   * @param string $label
   *   Site switcher link label.
   *
   * @return \Behat\Mink\Element\NodeElement
   *   Site switcher link element or throws an exception if none found.
   */
  protected function getSiteSwitcherLink($label): NodeElement {
    $element = $this->getSession()
      ->getPage()
      ->find('xpath', '//ul[contains(@class,"ecl-site-switcher__list")]//li[contains(.,"' . $label . '")]');
    if ($element === NULL) {
      throw new \RuntimeException("Site switcher link with label '{$label}' not found");
    }
    return $element;
  }

}
