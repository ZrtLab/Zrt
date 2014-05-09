<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Rand
 *
 * @author eanaya
 */
class Zrt_Controller_Action_Helper_Rand
        extends Zend_Controller_Action_Helper_Abstract
    {


    public function getRand( $max )
        {
        return rand( 1 , $max );
        }


    public function direct( $max )
        {
        return $this->getRand( $max );
        }


    }

