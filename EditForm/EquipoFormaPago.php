<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Zrt_EditForm_EquipoFormaPago
        extends Zrt_Form_EquipoFormaPago
    {


    public function init()
        {
        parent::init();
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmActualizarEquipoFormaPago' )
        ;




        //$this->removeElement( $this->precioVenta->getName() );
        //$this->removeElement( $this->publicacionEquipo->getName() );

        $this->submit->setLabel(
                $this->_translate->translate( 'actualizar' )
        );
        }


    public function __construct( $options = null )
        {

        parent::__construct( $options );
        }


    }

