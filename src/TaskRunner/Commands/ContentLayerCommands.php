<?php

declare(strict_types = 1);

namespace Ec\Europa\EuropaDemo\TaskRunner\Commands;

use Consolidation\AnnotatedCommand\AnnotationData;
use OpenEuropa\TaskRunner\Commands\AbstractCommands;
use Robo\Collection\CollectionBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

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

  /**
   * Drush commands on all sites at once.
   *
   * @param string $drush_command
   *   The Drush command.
   *
   * @command sites:parallel-drush
   */
  public function runParallelDrush(string $drush_command): void {
    $this->taskParallelExec()
      ->process('cd sites/info;./vendor/bin/drush ' . $drush_command)
      ->process('cd sites/inea;./vendor/bin/drush ' . $drush_command)
      ->process('cd sites/energy;./vendor/bin/drush ' . $drush_command)
      ->run();
  }

  /**
   * Run Drush commands on all sites.
   *
   * @command sites:drush
   */
  public function runDrushOnSites(): CollectionBuilder {
    list($args, $options) = func_get_args();
    $command = implode(' ', $args);

    if ($options['yes']) {
      $command .= ' -y';
    }

    return $this->getBuilder()->addTaskList([
      $this->taskExec("./vendor/bin/drush --root={$options['working-dir']}/sites/info $command"),
      $this->taskExec("./vendor/bin/drush --root={$options['working-dir']}/sites/inea $command"),
      $this->taskExec("./vendor/bin/drush --root={$options['working-dir']}/sites/energy $command"),
    ]);
  }

  /**
   * Run Task Runner commands on all sites.
   *
   * @command sites:run
   */
  public function runRunnerOnSites(): CollectionBuilder {
    list($args, $options) = func_get_args();
    $command = implode(' ', $args);

    if ($options['yes']) {
      $command .= ' -y';
    }

    return $this->getBuilder()->addTaskList([
      $this->taskExec("./vendor/bin/run --working-dir={$options['working-dir']}/sites/info $command"),
      $this->taskExec("./vendor/bin/run --working-dir={$options['working-dir']}/sites/inea $command"),
      $this->taskExec("./vendor/bin/run --working-dir={$options['working-dir']}/sites/energy $command"),
    ]);
  }

  /**
   * Dynamically add options and arguments to sites:drush.
   *
   * @hook option sites:drush
   */
  public function additionalSitesDrushOption(Command $command, AnnotationData $annotationData) {
    $command->addArgument('commands', InputOption::VALUE_OPTIONAL);
    $command->addOption('yes', 'y', InputOption::VALUE_NONE);
  }

  /**
   * Dynamically add options and arguments to sites:run.
   *
   * @hook option sites:run
   */
  public function additionalSitesRuneOption(Command $command, AnnotationData $annotationData) {
    $command->addArgument('commands', InputOption::VALUE_OPTIONAL);
    $command->addOption('yes', 'y', InputOption::VALUE_NONE);
  }

}
