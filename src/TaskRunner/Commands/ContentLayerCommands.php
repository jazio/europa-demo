<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\TaskRunner\Commands;

use OpenEuropa\TaskRunner\Commands\AbstractCommands;

/**
 * Class ContentLayerCommands.
 */
class ContentLayerCommands extends AbstractCommands {

  /**
   * Run parallel composer install in site directories.
   *
   * @command sites:parallel-composer-install
   */
  public function runParallelComposerInstall(): void {
    $this->taskParallelExec()
      ->process('cd sites/info;composer install')
      ->process('cd sites/inea;composer install')
      ->process('cd sites/energy;composer install')
      ->run();
  }

  /**
   * Run parallel composer update in site directories.
   *
   * @command sites:parallel-composer-update
   */
  public function runParallelComposerUpdate(): void {
    $this->taskParallelExec()
      ->process('cd sites/info;composer update')
      ->process('cd sites/inea;composer update')
      ->process('cd sites/energy;composer update')
      ->run();
  }

  /**
   * Run parallel site installs.
   *
   * @command sites:parallel-setup
   */
  public function runParallelSitesSetup(): void {
    $this->taskParallelExec()
      ->process('cd sites/info;./vendor/bin/run drupal:site-setup')
      ->process('cd sites/inea;./vendor/bin/run drupal:site-setup')
      ->process('cd sites/energy;./vendor/bin/run drupal:site-setup')
      ->run();
  }

  /**
   * Run parallel site installs.
   *
   * @command sites:parallel-install
   */
  public function runParallelSitesInstall(): void {
    $this->taskParallelExec()
      ->process('cd sites/info;./vendor/bin/run drupal:site-install')
      ->process('cd sites/inea;./vendor/bin/run drupal:site-install')
      ->process('cd sites/energy;./vendor/bin/run drupal:site-install')
      ->run();
  }

}
