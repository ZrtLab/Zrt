<?php

/**
 * Zrt PHP Library
 *
 * @category Zrt
 * @package Zrt_Model
 * @copyright Copyright (c) 2008-2010 Jamie Talbot (http://jamietalbot.com)
 * @version $Id$
 */


/**
 * Exception to be thrown when models aren't found.
 *
 * @category Zrt
 * @package Zrt_Model
 */
class Zrt_Model_Exception_NotFound
        extends Exception
    {


    public function __construct( $message , $code = null , $previous = null )
        {
        parent::__construct( $message , Zrt_Http::NOT_FOUND , $previous );


        }


    }