<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Zrt_EditForm_Cms
        extends Zrt_Form_Cms
    {


    public function init()
        {
        parent::init();
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmActualizarPagina' )
        ;
        }


    public function __construct( $options = null )
        {

        parent::__construct( $options );
        }


    }

