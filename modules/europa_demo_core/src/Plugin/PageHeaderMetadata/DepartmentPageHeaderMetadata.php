<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Plugin\PageHeaderMetadata;

use Drupal\oe_theme_helper\Plugin\PageHeaderMetadata\EntityCanonicalRoutePageHeaderMetadata;
use Drupal\rdf_entity\RdfInterface;

/**
 * Page header metadata plugin for the current department RDF entity.
 *
 * @PageHeaderMetadata(
 *   id = "department_rdf_entity",
 *   label = @Translation("Department page metadata extractor")
 * )
 */
class DepartmentPageHeaderMetadata extends EntityCanonicalRoutePageHeaderMetadata {

  /**
   * {@inheritdoc}
   */
  public function applies(): bool {
    $entity = $this->getEntityFromCurrentRoute();
    return $entity instanceof RdfInterface && $entity->bundle() === 'oe_department';
  }

  /**
   * {@inheritdoc}
   */
  public function getMetadata(): array {
    $metadata = parent::getMetadata();

    $entity = $this->getEntityFromCurrentRoute();
    if ($entity->get('oe_department_description')->value) {
      $metadata['introduction'] = [
        '#plain_text' => $entity->get('oe_department_description')->value,
      ];
    }

    $metas = [];

    /** @var \Drupal\taxonomy\TermInterface $department_type */
    $department_type = $entity->get('oe_department_type')->entity;
    $metas[] = $department_type->label();

    /** @var \Drupal\taxonomy\TermInterface[] $subjects */
    $subjects = $entity->get('oe_department_subject')->referencedEntities();
    $labels = [];
    foreach ($subjects as $subject) {
      $labels[] = $subject->label();
    }
    $metas[] = implode(', ', $labels);

    $metadata['metas'] = $metas;
    $metadata['identity'] = '';

    return $metadata;
  }

}
