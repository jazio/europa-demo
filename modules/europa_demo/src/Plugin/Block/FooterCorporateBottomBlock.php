<?php

declare(strict_types = 1);

namespace Drupal\europa_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Footer corporate bottom' block.
 *
 * @Block(
 *   id = "europa_demo_footer_corporate_bottom",
 *   admin_label = @Translation("Footer corporate: bottom"),
 *   category = @Translation("Europa Demo")
 * )
 */
class FooterCorporateBottomBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build = [
      '#theme' => 'europa_demo_footer_corporate_bottom',
    ];

    return $build;
  }

}
