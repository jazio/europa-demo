<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_site_content\EventSubscriber;

use Drupal\default_content\Event\DefaultContentEvents;
use Drupal\default_content\Event\ImportEvent;
use Drupal\pathauto\PathautoState;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Content import event subscriber.
 */
class ContentImportSubscriber implements EventSubscriberInterface {

  /**
   * List of URL aliases keyed by the related node's UUID.
   *
   * @var array
   */
  private $aliases;

  /**
   * ContentImportSubscriber constructor.
   *
   * @param array $aliases
   *   URL aliases keyed by the related node's UUID.
   */
  public function __construct(array $aliases) {
    $this->aliases = $aliases;
  }

  /**
   * Import content event handler.
   *
   * @param \Drupal\default_content\Event\ImportEvent $event
   *   Event object.
   */
  public function onImport(ImportEvent $event): void {
    // Default Content cannot export URL aliases.
    // @todo: Fix this once the following issue is resolved.
    // @link https://www.drupal.org/project/default_content/issues/2710421
    $entities = $event->getImportedEntities();
    foreach ($this->aliases as $uuid => $alias) {
      $node = isset($entities[$uuid]) ? $entities[$uuid] : NULL;
      if (!$node) {
        continue;
      }

      foreach ($node->getTranslationLanguages() as $language) {
        $translation = $node->getTranslation($language->getId());
        $translation->path = [
          'pathauto' => PathautoState::SKIP,
          'alias' => $alias,
        ];
        $translation->save();
      }

    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents(): array {
    $events[DefaultContentEvents::IMPORT][] = ['onImport'];
    return $events;
  }

}
