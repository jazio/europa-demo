<?php

namespace Drupal\europa_demo_content\Controller;
use Drupal\Core\Url;

/**
 * News controller.
 */
class NewsController extends RdfEntityPageControllerBase {

  /**
   * Builds the News page.
   */
  public function build() {
    $ids = $this->getQuery()
      ->condition('rid', 'oe_announcement')
      ->execute();

    $announcements = $this->entityTypeManager->getStorage('rdf_entity')->loadMultiple($ids);
    $items = [];

    foreach ($announcements as $announcement) {
    }

    $build = [
      '#cache' => [
        'tags' => ['rdf_entity_list'],
      ]
    ];

    $build[] = [
      '#type' => 'pattern',
      '#id' => 'list_item_block_one_column',
      '#fields' => [
        'items' => $items,
      ],
    ];

    return $build;
  }

}