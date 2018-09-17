<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Controller;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\rdf_entity\RdfInterface;

/**
 * News controller.
 */
class NewsController extends RdfEntityPageControllerBase {

  /**
   * Builds the News page.
   */
  public function build(): array {
    $query = $this->getQuery()
      ->condition('rid', 'oe_announcement');

    // On the Energy site, we need to filter by a tag.
    $provenance_uri = $this->configFactory->get('oe_content.settings')->get('provenance_uri');
    if ($provenance_uri === 'http://ec.europa.eu/energy') {
      $terms = $this->entityTypeManager->getStorage('taxonomy_term')->loadByProperties(['name' => ['energy policy']]);
      $ids = array_keys($terms);
      $query->condition('oe_announcement_subject', $ids, 'IN');
    }

    $ids = $query->execute();
    $entities = $this->entityTypeManager->getStorage('rdf_entity')->loadMultiple($ids);

    // The Sparql query does not allow for sorting so we need to sort here.
    uasort($entities, function (RdfInterface $a, RdfInterface $b) {
      $a_date = DrupalDateTime::createFromTimestamp($a->get('oe_announcement_publish_date')->value);
      $b_date = DrupalDateTime::createFromTimestamp($b->get('oe_announcement_publish_date')->value);

      if ($a_date === $b_date) {
        return 0;
      }

      return ($a_date > $b_date) ? -1 : 1;
    });

    return $this->buildPattern('list_item_block_one_column', 'announcement', $entities);
  }

}
