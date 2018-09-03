<?php

declare(strict_types = 1);

namespace Ec\Europa\ContentLayerDemo\TaskRunner\Commands;

use OpenEuropa\TaskRunner\Commands\AbstractCommands;

/**
 * Class ContentLayerCommands.
 */
class ContentLayerCommands extends AbstractCommands {

  /**
   * Run parallel composer install in site directories.
   *
   * @command drupal:parallel-composer-install
   */
  public function runParallelComposerInstall(): void {
    $this->taskParallelExec()
      ->process('cd sites/rtd;composer install')
      ->process('cd sites/agri;composer install')
      ->process('cd sites/energy;composer install')
      ->run();
  }

  /**
   * Run parallel composer update in site directories.
   *
   * @command drupal:parallel-composer-update
   */
  public function runParallelComposerUpdate(): void {
    $this->taskParallelExec()
      ->process('cd sites/rtd;composer update')
      ->process('cd sites/agri;composer update')
      ->process('cd sites/energy;composer update')
      ->run();
  }

  /**
   * Run parallel site installs.
   *
   * @command drupal:parallel-sites-setup
   */
  public function runParallelSitesSetup(): void {
    $this->taskParallelExec()
      ->process('cd sites/rtd;./vendor/bin/run drupal:site-setup')
      ->process('cd sites/agri;./vendor/bin/run drupal:site-setup')
      ->process('cd sites/energy;./vendor/bin/run drupal:site-setup')
      ->run();
  }

  /**
   * Run parallel site installs.
   *
   * @command drupal:parallel-sites-install
   */
  public function runParallelSitesInstall(): void {
    $this->taskParallelExec()
      ->process('cd sites/rtd;./vendor/bin/run drupal:site-install')
      ->process('cd sites/agri;./vendor/bin/run drupal:site-install')
      ->process('cd sites/energy;./vendor/bin/run drupal:site-install')
      ->run();
  }

}
