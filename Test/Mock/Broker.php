<?php

/**
 * Zrt PHP Library
 *
 * @category Zrt
 * @package Zrt_Test
 * @copyright Copyright (c) 2008-2010 Jamie Talbot (http://jamietalbot.com)
 * @version $Id: Broker.php 69 2010-09-08 12:32:03Z jamie $
 */


/**
 * Decorator object that provides a gateway for mocking objects.
 *
 * @category Zrt
 * @package Zrt_Test
 */
class Zrt_Test_Mock_Broker
    {

    protected $_prefix = null;
    protected $_mockGenerators = array( );


    public function __construct( $prefix )
        {
        $this->_prefix = $prefix;


        }


    public function __call( $method , $arguments )
        {
        include_once(ucfirst( $method ) . '.php');

        if ( !array_key_exists( $method , $this->_mockGenerators ) )
            {
            $mockClass = $this->_prefix . ucfirst( $method );
            $this->_mockGenerators[$method] = new $mockClass();
            }
        $generator = $this->_mockGenerators[$method];
        call_user_func_array( array( $generator , 'mock' ) , $arguments );

        return $this;


        }


    }