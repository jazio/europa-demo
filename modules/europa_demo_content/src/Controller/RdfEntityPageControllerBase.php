<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_content\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\Query\QueryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Base controller class for the RDF entity list pages.
 */
class RdfEntityPageControllerBase extends ControllerBase {

  /**
   * Entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a RdfEntityPageControllerBase.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): RdfEntityPageControllerBase {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * Creates a base query for RDF entities.
   */
  protected function getQuery(): QueryInterface {
    return $this->entityTypeManager->getStorage('rdf_entity')->getQuery();
  }

}
