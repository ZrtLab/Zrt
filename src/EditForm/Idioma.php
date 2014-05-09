<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Zrt_EditForm_Idioma
        extends Zrt_Formy
    {

    protected $nombre;
    protected $prefijo;
    protected $submit;


    public function init()
        {
        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmIdioma' )
        ;

        $this->nombre = new Zend_Form_Element_Text( 'nombre' );
        $this->nombre->setLabel(
                        $this->_translate->translate( 'idioma' )
                )
                ->setRequired()
                ->addValidator( new Zend_Validate_Db_NoRecordExists(
                                array(
                                    'table' => 'idiomas' ,
                                    'field' => 'nombre'
                                )
                ) )
        ;
        $this->addElement( $this->nombre );


        $this->prefijo = new Zend_Form_Element_Text( 'prefijo' );
        $this->prefijo->setLabel(
                        $this->_translate->translate( 'prefijo' )
                )
                ->setRequired()
        ;

        $this->addElement( $this->prefijo );




        $this->submit = new Zend_Form_Element_Button( 'submit' );
        $this->submit->setLabel(
                $this->_translate->translate( 'guardar' ) );
        $this->submit->setAttrib( 'type' , 'submit' )

        ;
        $this->addElement( $this->submit );
        }


    }

