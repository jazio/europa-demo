<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Plugin\ConfigFilter;

use Drupal\config_filter\Plugin\ConfigFilterBase;

/**
 * Makes sure that Europa Demo Content module is never exported.
 *
 * @ConfigFilter(
 *   id = "europa_demo_core_ignore_content_module",
 *   label = @Translation("Ignore content module"),
 *   storages = {"config.storage.sync"}
 * )
 */
class IgnoreContentModuleFilter extends ConfigFilterBase {

  /**
   * {@inheritdoc}
   */
  public function filterRead($name, $data) {
    if ($name === 'core.extension') {
      $data['module']['europa_demo_content'] = 0;
      $data['module'] = module_config_sort($data['module']);
    }

    return $data;
  }

  /**
   * {@inheritdoc}
   */
  public function filterReadMultiple(array $names, array $data) {
    if (in_array('core.extension', $names)) {
      $data['core.extension']['module']['europa_demo_content'] = 0;
      $data['core.extension']['module'] = module_config_sort($data['core.extension']['module']);
    }

    return $data;
  }

  /**
   * {@inheritdoc}
   */
  public function filterWrite($name, array $data) {
    if ($name === 'core.extension') {
      unset($data['module']['europa_demo_content']);
    }

    return $data;
  }

}
