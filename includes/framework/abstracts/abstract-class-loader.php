<?php

namespace Main\Framework\Abstracts;

use Main\Framework\Loader;

/**
 * Class Loader_Abstract
 *
 * Added in order to access the main loader easily without passing it everywhere.
 *
 * @package Main\Framework\Abstracts
 */
abstract class Loader_Abstract {
	public $loader;

	/**
	 * Loader_Abstract constructor.
	 */
	public function __construct() {
		$this->loader = Loader::get_instance();
	}
}