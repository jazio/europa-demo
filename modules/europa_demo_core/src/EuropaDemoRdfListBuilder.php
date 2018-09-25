<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Routing\RedirectDestinationInterface;
use Drupal\rdf_entity\Entity\Controller\RdfListBuilder;
use Drupal\rdf_entity\RdfInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Overriding the default RDF entity list builder.
 *
 * Adding extra columns to the table.
 */
class EuropaDemoRdfListBuilder extends RdfListBuilder {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new EuropaDemoRdfListBuilder object.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager.
   * @param \Drupal\Core\Entity\EntityStorageInterface $storage
   *   The entity storage class.
   * @param \Drupal\Core\Routing\RedirectDestinationInterface $redirect_destination
   *   The redirect destination service.
   */
  public function __construct(EntityTypeInterface $entity_type, EntityTypeManagerInterface $entityTypeManager, EntityStorageInterface $storage, RedirectDestinationInterface $redirect_destination) {
    parent::__construct($entity_type, $storage, $redirect_destination);
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity_type.manager'),
      $container->get('entity_type.manager')->getStorage($entity_type->id()),
      $container->get('redirect.destination')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header = [];
    $parent_header = parent::buildHeader();
    $header['id'] = $parent_header['id'];
    $header['provenance'] = [
      'data' => $this->t('Content owner'),
    ];
    unset($parent_header['id']);
    return $header + $parent_header;
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    $row = [];
    $parent_row = parent::buildRow($entity);
    $row['id'] = $parent_row['id'];
    $row['provenance'] = $this->getProducerForEntity($entity);
    $bundle = $this->entityTypeManager->getStorage('rdf_type')->load($parent_row['rid']);
    $row['rid'] = $bundle->label();
    unset($parent_row['rid']);
    unset($parent_row['id']);
    return $row + $parent_row;
  }

  /**
   * Return a readable name for the provenance URI of the RDF entity.
   *
   * @param \Drupal\rdf_entity\RdfInterface $entity
   *   The entity.
   *
   * @return string
   *   The label of the provenance URI.
   */
  protected function getProducerForEntity(RdfInterface $entity): string {
    $mapping = [
      'http://ec.europa.eu/inea' => 'INEA',
      'http://ec.europa.eu/info' => 'INFO',
      'http://ec.europa.eu/energy' => 'ENERGY',
    ];

    $uri = $entity->get('provenance_uri')->value;
    return isset($mapping[$uri]) ? $mapping[$uri] : 'N/A';
  }

}
