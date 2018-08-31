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
      ->process('cd site-rtd;composer install')
      ->process('cd site-agri;composer install')
      ->process('cd site-energy;composer install')
      ->run();
  }

  /**
   * Run parallel composer update in site directories.
   *
   * @command drupal:parallel-composer-update
   */
  public function runParallelComposerUpdate(): void {
    $this->taskParallelExec()
      ->process('cd site-rtd;composer update')
      ->process('cd site-agri;composer update')
      ->process('cd site-energy;composer update')
      ->run();
  }

  /**
   * Run parallel site installs.
   *
   * @command drupal:parallel-sites-setup
   */
  public function runParallelSitesSetup(): void {
    $this->taskParallelExec()
      ->process('cd site-rtd;./vendor/bin/run drupal:site-setup')
      ->process('cd site-agri;./vendor/bin/run drupal:site-setup')
      ->process('cd site-energy;./vendor/bin/run drupal:site-setup')
      ->run();
  }

  /**
   * Run parallel site installs.
   *
   * @command drupal:parallel-sites-install
   */
  public function runParallelSitesInstall(): void {
    $this->taskParallelExec()
      ->process('cd site-rtd;./vendor/bin/run drupal:site-install')
      ->process('cd site-agri;./vendor/bin/run drupal:site-install')
      ->process('cd site-energy;./vendor/bin/run drupal:site-install')
      ->run();
  }

}
