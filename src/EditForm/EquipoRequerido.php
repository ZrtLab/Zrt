<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Zrt_EditForm_EquipoRequerido
		extends Zrt_Form_EquipoRequerido
{


	public function init()
	{
		parent::init() ;
		$this
				->setMethod( 'post' )
				->setAttrib( 'id' , 'frmActualizarEquipoRequerido' )
		;

		$this->submit->setLabel(
				$this->_translate->translate( 'actualizar' )
		) ;


	}


	public function __construct( $options = null )
	{

		parent::__construct( $options ) ;


	}


}

