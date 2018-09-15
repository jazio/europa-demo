<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Controller;

/**
 * News controller.
 */
class NewsController extends RdfEntityPageControllerBase {

  /**
   * Builds the News page.
   */
  public function build(): array {
    $ids = $this->getQuery()
      ->condition('rid', 'oe_announcement')
      ->execute();

    // Use list item block pattern to render announcement list.
    // We set a custom pattern context so that we can get advantage of theme
    // suggestions and preprocess set via hook_ui_patterns_suggestions_alter().
    // @see europa_demo_core_ui_patterns_suggestions_alter()
    // @see europa_demo_theme_preprocess_pattern_list_item_block_one_column__entity_list__rdf_entity__announcement()
    $build[] = [
      '#type' => 'pattern',
      '#id' => 'list_item_block_one_column',
      '#context' => [
        'type' => 'entity_list',
        'entity_type' => 'rdf_entity',
        'bundle' => 'announcement',
        'entities' => $this->entityTypeManager->getStorage('rdf_entity')->loadMultiple($ids),
      ],
      '#cache' => [
        'tags' => ['rdf_entity_list'],
      ],
    ];

    return $build;
  }

}
