<?php
/**
 * Created by PhpStorm.
 * User: richard
 * Date: 10/08/2018
 * Time: 13:17
 */

namespace Ec\Europa\ContentLayerDemo\TaskRunner\Commands;

use OpenEuropa\TaskRunner\Commands\AbstractCommands;

/**
 * Class ContentLayerCommands
 *
 * @package Ec\Europa\ContentLayerDemo\TaskRunner\Commands
 */

class ContentLayerCommands extends AbstractCommands {

	/**
	 * @command content-layer-demo:demoSitesSetup
	 */
	public function demoSitesSetup() {
		$this->taskParallelExec()
		     ->process('cd site-a;composer install')
		     ->process('cd site-b;composer install')
		     ->process('cd site-c;composer install')
		     ->run();

	}

	/**
	 * @command content-layer-demo:demoSitesInstall
	 */
	public function demoSitesInstall() {
		$this->taskParallelExec()
		     ->process('cd site-a;./vendor/bin/run drupal:site-install')
		     ->process('cd site-b;./vendor/bin/run drupal:site-install')
		     ->process('cd site-c;./vendor/bin/run drupal:site-install')
		     ->run();
	}
}
