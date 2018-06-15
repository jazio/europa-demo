<?php

declare(strict_types = 1);

namespace Drupal\europa_demo\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Site switcher' block.
 *
 * @Block(
 *   id = "europa_demo_site_switcher",
 *   admin_label = @Translation("Site switcher"),
 *   category = @Translation("Europa Demo")
 * )
 */
class SiteSwitcherBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $build = [
      '#theme' => 'europa_demo_site_switcher',
    ];

    return $build;
  }

}
