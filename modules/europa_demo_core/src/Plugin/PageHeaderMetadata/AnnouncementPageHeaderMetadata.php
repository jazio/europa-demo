<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Plugin\PageHeaderMetadata;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\oe_theme_helper\Plugin\PageHeaderMetadata\EntityCanonicalRoutePageHeaderMetadata;
use Drupal\rdf_entity\RdfInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Page header metadata plugin for the current announcement RDF entity.
 *
 * @PageHeaderMetadata(
 *   id = "announcement_rdf_entity",
 *   label = @Translation("Announcement page metadata extractor")
 * )
 */
class AnnouncementPageHeaderMetadata extends EntityCanonicalRoutePageHeaderMetadata {

  use StringTranslationTrait;

  /**
   * The date formatter.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Creates a new EntityPageHeaderMetadata object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Routing\RouteMatchInterface $current_route_match
   *   The current route match.
   * @param \Drupal\Core\Datetime\DateFormatterInterface $dateFormatter
   *   The date formatter.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, RouteMatchInterface $current_route_match, DateFormatterInterface $dateFormatter) {
    parent::__construct($configuration, $plugin_id, $plugin_definition, $current_route_match);
    $this->currentRouteMatch = $current_route_match;
    $this->dateFormatter = $dateFormatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
      $container->get('date.formatter')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function applies(): bool {
    $entity = $this->getEntityFromCurrentRoute();
    return $entity instanceof RdfInterface && $entity->bundle() === 'oe_announcement';
  }

  /**
   * {@inheritdoc}
   */
  public function getMetadata(): array {
    $metadata = parent::getMetadata();
    $entity = $this->getEntityFromCurrentRoute();
    if ($entity->get('oe_announcement_introduction')->value) {
      $metadata['introduction'] = [
        '#plain_text' => $entity->get('oe_announcement_introduction')->value,
      ];
    }

    $metas = [];
    $timestamp = $entity->get('oe_announcement_publish_date')->value;
    $metas[] = $this->t('Published @date', [
      '@date' => $this->dateFormatter->format($timestamp, 'custom', 'F d, Y'),
    ]);
    $metas[] = $entity->get('oe_announcement_location')->value;
    $metas[] = $entity->get('oe_announcement_department')->entity->label();
    $metadata['metas'] = $metas;

    $metadata['identity'] = '';
    return $metadata;
  }

}
