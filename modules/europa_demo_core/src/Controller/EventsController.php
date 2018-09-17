<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Controller;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\rdf_entity\RdfInterface;

/**
 * Event controller.
 */
class EventsController extends RdfEntityPageControllerBase {

  /**
   * Builds the News page.
   */
  public function build(): array {
    $ids = $this->getQuery()
      ->condition('rid', 'oe_event')
      ->execute();

    $entities = $this->entityTypeManager->getStorage('rdf_entity')->loadMultiple($ids);

    // The Sparql query does not allow for sorting so we need to sort here.
    uasort($entities, function (RdfInterface $a, RdfInterface $b) {
      $a_date = DrupalDateTime::createFromTimestamp($a->get('oe_event_start_date')->value);
      $b_date = DrupalDateTime::createFromTimestamp($b->get('oe_event_start_date')->value);

      if ($a_date === $b_date) {
        return 0;
      }

      return ($a_date < $b_date) ? -1 : 1;
    });

    return $this->buildPattern('list_item_block_one_column', 'event', $entities);
  }

}
