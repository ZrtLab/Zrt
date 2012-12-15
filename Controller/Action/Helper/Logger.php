<?php

/**
 * Take the main logger and put it as a Action Helper
 *
 * @category Zrt
 * @package Zrt_Controller
 * @copyright company
 */
class Zrt_Controller_Action_Helper_Logger extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * Logger to use
     *
     * @var Object
     */
    private $_logger;

    /**
     * Called automatically after creating the object
     *
     * @return void
     */
    public function init()
    {
        //Retrieve the main logger from the registry
        $this->_logger = Zrt_DI_Container::get('GeneralLog');
    }

    /**
     * This method is called automatically when using the name of the helper directly
     *
     * @param string $message 
     * @param string $debugLevel 
     * @return void
     */
    public function direct($message, $debugLevel = Zend_Log::INFO)
    {
        $this->_logger->log($message, $debugLevel);
    }

    /**
     * Used to passthru Wildfire's err(), info() etc functions.
     * @param $name string
     * @param $arguments array
     * @return void
     */
    public function __call($name, $arguments)
    {
        try {
            $this->_logger->$name($arguments[0]);
        } catch (Zend_Exception $e) {
            // There was an error logging this error, so log that instead! :)
            $this->direct($e->getMessage() . ": $name", Zend_Log::ERR);
        }
    }

}