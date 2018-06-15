<?php

declare(strict_types = 1);

namespace Drupal\europa_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a search block.
 *
 * @Block(
 *   id = "europa_demo_search",
 *   admin_label = @Translation("Search"),
 *   category = @Translation("Europa Demo")
 * )
 */
class SearchBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build = [
      '#theme' => 'europa_demo_search',
    ];

    return $build;
  }

}
