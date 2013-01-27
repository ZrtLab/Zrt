<?php
/**
 * Zrt PHP Library
 *
 * @category Zrt
 * @package Zrt_Controller
 * @copyright Copyright (c) 2008-2010 Jamie Talbot (http://jamietalbot.com)
 * @version $Id: Auth.php 69 2010-09-08 12:32:03Z jamie $
 */

/**
 * Standard authorisation controller.
 *
 * @category Zrt
 * @package Zrt_Controller
 */
abstract class Zrt_Controller_Auth extends Zend_Controller_Action {

	/**
	 * Logs a user out of the application.
	 */
	public function logoutAction() {
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$auth->clearIdentity();
		}
		$redirectSession = new Zend_Session_Namespace('Redirect');
		$location = $redirectSession->location ? $redirectSession->location : '/';
		$this->_redirect($location);
	}
}
?>