<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


abstract class Zrt_Db_Table_Abstract
        extends Zend_Db_Table_Abstract
    {

    const ACTIVE = 1;
    const DESACTIVATE = 0;


    //protected $sessionZrt;
    //protected $objtranslate;


    public function __construct( $config = array( ) )
        {
        //$this->sessionZrt = new Zend_Session_Namespace( 'Zrt' );
        parent::__construct( $config );
        }


    public function getFindId( $id )
        {
        return $this->fetchRow(
                        $this->_primary . ' = ' . $id
        );
        }


    }