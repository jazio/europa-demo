<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Plugin\PageHeaderMetadata;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\oe_theme_helper\Plugin\PageHeaderMetadata\EntityCanonicalRoutePageHeaderMetadata;

/**
 * Defines a page header metadata plugin that extracts data from current entity.
 *
 * @PageHeaderMetadata(
 *   id = "landing_page",
 *   label = @Translation("Landing page metadata extractor")
 * )
 */
class LandingPagePageHeaderMetadata extends EntityCanonicalRoutePageHeaderMetadata {

  /**
   * {@inheritdoc}
   */
  public function applies(): bool {
    $entity = $this->getEntityFromCurrentRoute();
    return !empty($entity) && $entity->bundle() === 'landing_page';
  }

  /**
   * {@inheritdoc}
   */
  public function getMetadata(): array {
    $entity = $this->getEntityFromCurrentRoute();

    // Get values from entity.
    $title = $entity->label();
    $introduction = !$entity->get('field_introduction')->isEmpty() ? $entity->get('field_introduction')->getString() : '';
    $metadata = [
      'title' => $title,
      'introduction' => $introduction,
    ];

    $cacheability = new CacheableMetadata();
    $cacheability
      ->addCacheableDependency($entity)
      ->addCacheContexts(['route'])
      ->applyTo($metadata);

    return $metadata;
  }

}
