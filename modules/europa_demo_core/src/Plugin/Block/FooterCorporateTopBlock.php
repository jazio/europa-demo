<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Footer corporate top' block.
 *
 * @Block(
 *   id = "europa_demo_footer_corporate_top",
 *   admin_label = @Translation("Footer corporate: top"),
 *   category = @Translation("Europa Demo")
 * )
 */
class FooterCorporateTopBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build = [
      '#theme' => 'europa_demo_footer_corporate_top',
    ];

    return $build;
  }

}
