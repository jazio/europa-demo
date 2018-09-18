<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\Behat;

use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Gherkin\Node\TableNode;

/**
 * Mink-based context.
 */
class MinkContext extends RawMinkContext {

  /**
   * Assert links on page.
   *
   * @param \Behat\Gherkin\Node\TableNode $links
   *   List of links.
   *
   * @throws \Exception
   *
   * @Then I should see the following links:
   */
  public function assertLinksOnPage(TableNode $links): void {
    foreach ($links->getRows() as $row) {
      $result = $this->getSession()->getPage()->findLink($row[0]);
      if (empty($result)) {
        throw new \Exception(sprintf('No link "%s" found on page %s', $row[0], $this->getSession()->getCurrentUrl()));
      }
    }
  }

  /**
   * Assert missing links on page.
   *
   * @param \Behat\Gherkin\Node\TableNode $links
   *   List of links.
   *
   * @throws \Exception
   *
   * @Then I should not see the following links:
   */
  public function assertMissingLinksOnPage(TableNode $links): void {
    foreach ($links->getRows() as $row) {
      $result = $this->getSession()->getPage()->findLink($row[0]);
      if (!empty($result)) {
        throw new \Exception(sprintf('Link to "%s" found on page %s', $row[0], $this->getSession()->getCurrentUrl()));
      }
    }
  }

}
