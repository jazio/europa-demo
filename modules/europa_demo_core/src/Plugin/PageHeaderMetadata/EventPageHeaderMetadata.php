<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Plugin\PageHeaderMetadata;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\oe_theme_helper\Plugin\PageHeaderMetadata\EntityCanonicalRoutePageHeaderMetadata;
use Drupal\rdf_entity\RdfInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Page header metadata plugin for the current event RDF entity.
 *
 * @PageHeaderMetadata(
 *   id = "event_rdf_entity",
 *   label = @Translation("Event page metadata extractor")
 * )
 */
class EventPageHeaderMetadata extends EntityCanonicalRoutePageHeaderMetadata {

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
    return $entity instanceof RdfInterface && $entity->bundle() === 'oe_event';
  }

  /**
   * {@inheritdoc}
   */
  public function getMetadata(): array {
    $metadata = parent::getMetadata();

    /** @var \Drupal\rdf_entity\RdfInterface $entity */
    $entity = $this->getEntityFromCurrentRoute();
    if ($entity->get('oe_event_introduction')->value) {
      $metadata['introduction'] = [
        '#plain_text' => $entity->get('oe_event_introduction')->value,
      ];
    }

    $metas = [];
    $metas[] = $this->formatDate($entity);
    $metas[] = $entity->get('oe_event_organiser')->entity->label();

    $metadata['metas'] = $metas;
    $metadata['identity'] = '';

    return $metadata;
  }

  /**
   * Formats the date of a given Event RDF entity.
   *
   * @param \Drupal\rdf_entity\RdfInterface $entity
   *   The RDF entity.
   *
   * @return string
   *   The formatted date.
   */
  protected function formatDate(RdfInterface $entity): string {
    $start_timestamp = $entity->get('oe_event_start_date')->value;
    $end_timestamp = $entity->get('oe_event_end_date')->value;
    if (date('d m y', $start_timestamp) === date('d m y', $end_timestamp)) {
      // The event starts and ends on the same day.
      return date('H:i', $start_timestamp) === date('H:i', $end_timestamp) ?
        $this->dateFormatter->format($start_timestamp, 'custom', 'F d, Y - H:i') :
        $this->dateFormatter->format($start_timestamp, 'custom', 'F d, Y / H:i') . ' - ' . $this->dateFormatter->format($end_timestamp, 'custom', 'H:i');
    }

    // Otherwise we have a multiday event.
    return $this->dateFormatter->format($start_timestamp, 'custom', 'F d, Y - H:i') . ' - ' . $this->dateFormatter->format($end_timestamp, 'custom', 'F d, Y - H:i');
  }

}
