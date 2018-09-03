<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Plugin\PageHeaderMetadata;

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
    $metadata = parent::getMetadata();

    $entity = $this->getEntityFromCurrentRoute();
    if (!$entity->get('field_introduction')->isEmpty()) {
      $metadata['introduction'] = $entity->get('field_introduction')->getString();
    }

    return $metadata;
  }

}
