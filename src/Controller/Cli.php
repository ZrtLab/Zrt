<?php
/**
 * Zrt PHP Library
 *
 * @category Zrt
 * @package Zrt_Controller
 * @copyright Copyright (c) 2008-2010 Jamie Talbot (http://jamietalbot.com)
 * @version $Id: Cli.php 69 2010-09-08 12:32:03Z jamie $
 */

/**
 * CLI controller
 *
 * @category Zrt
 * @package Zrt_Controller
 */
abstract class Zrt_Controller_Cli extends Zend_Controller_Action {

	/**
	 * Make sure we can only access these tasks from the command line.
	 */
	public function init() {
		$request = $this->getRequest();
		if (!$request instanceof Zrt_Controller_Request_Cli) {
			throw new Zrt_Exception('Command Line Tasks may only be accessed from the command line');
		}

		return parent::init();
	}
}