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
      ->process('cd site-a;composer install')
      ->process('cd site-b;composer install')
      ->process('cd site-c;composer install')
      ->run();

  }

  /**
   * Run parallel site installs.
   *
   * @command drupal:parallel-sites-setup
   */
  public function runParallelSitesSetup(): void {
    $this->taskParallelExec()
      ->process('cd site-a;./vendor/bin/run drupal:site-setup')
      ->process('cd site-b;./vendor/bin/run drupal:site-setup')
      ->process('cd site-c;./vendor/bin/run drupal:site-setup')
      ->run();
  }

  /**
   * Run parallel site installs.
   *
   * @command drupal:parallel-sites-install
   */
  public function runParallelSitesInstall(): void {
    $this->taskParallelExec()
      ->process('cd site-a;./vendor/bin/run drupal:site-install')
      ->process('cd site-b;./vendor/bin/run drupal:site-install')
      ->process('cd site-c;./vendor/bin/run drupal:site-install')
      ->run();
  }

}
