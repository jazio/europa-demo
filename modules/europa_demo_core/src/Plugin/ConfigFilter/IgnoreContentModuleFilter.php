<?php

declare(strict_types = 1);

namespace Drupal\europa_demo_core\Plugin\ConfigFilter;

use Drupal\config_filter\Plugin\ConfigFilterBase;

/**
 * Makes sure that Europa Demo Content module is never exported.
 *
 * When the Europa Demo Content is installed by the Config Installer profile
 * content entities containing images will not be imported, this is due to the
 * fact that we cannot be sure of which configuration is imported when
 * hook_install() is ran by the Config Installer profile.
 *
 * The solution is to enable the Europa Demo Content module after the site is
 * installed: this is taken care by the Task Runner.
 *
 * However having the module being enabled would be stored in the active
 * configuration and saved in `../config/sync` when configuration is exported.
 *
 * This plugin makes sure that we never export the Europa Demo Content module
 * being enabled and we always pretend it is when configuration is read.
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
