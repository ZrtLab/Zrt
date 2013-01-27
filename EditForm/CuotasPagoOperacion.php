<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Zrt_EditForm_CuotasPagoOperacion
        extends Zrt_Form_CuotasPagoOperacion
    {


    public function init()
        {
        parent::init();
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmActualizarCuotasPagoOperacion' )
        ;

        $this->removeElement( $this->restante->getName() );


        $this->submit->setLabel(
                $this->_translate->translate( 'actualizar' )
        );
        }


    public function __construct( $options = null )
        {

        parent::__construct( $options );
        }


    }

