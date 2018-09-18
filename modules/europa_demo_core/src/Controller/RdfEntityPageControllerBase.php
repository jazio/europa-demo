<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Controller;

use Drupal\Core\Config\ConfigFactoryInterface;
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
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The Entity type manager.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   The config factory.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, ConfigFactoryInterface $configFactory) {
    $this->entityTypeManager = $entityTypeManager;
    $this->configFactory = $configFactory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): RdfEntityPageControllerBase {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('config.factory')
    );
  }

  /**
   * Creates a base query for RDF entities.
   */
  protected function getQuery(): QueryInterface {
    return $this->entityTypeManager->getStorage('rdf_entity')->getQuery();
  }

  /**
   * Builds the render array for the list pattern.
   *
   * @param string $id
   *   Pattern Id.
   * @param string $context_bundle
   *   Entity bundle.
   * @param array $entities
   *   The entities to render.
   *
   * @return array
   *   A renderable array.
   */
  protected function buildPattern(string $id, string $context_bundle, array $entities): array {
    // Use list item block pattern to render announcement list.
    // We set a custom pattern context so that we can get advantage of theme
    // suggestions and preprocess set via hook_ui_patterns_suggestions_alter().
    // @see europa_demo_core_ui_patterns_suggestions_alter()
    // @see europa_demo_theme_preprocess_pattern_list_item_block_one_column__entity_list__rdf_entity__announcement()
    return [
      '#type' => 'pattern',
      '#id' => $id,
      '#context' => [
        'type' => 'entity_list',
        'entity_type' => 'rdf_entity',
        'bundle' => $context_bundle,
        'entities' => $entities,
      ],
      '#cache' => [
        'tags' => ['rdf_entity_list'],
      ],
    ];
  }

}
