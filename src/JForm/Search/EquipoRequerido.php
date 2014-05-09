<?php


class Zrt_JForm_Search_EquipoRequerido
        extends Zrt_Form
    {

    protected $nombre;
    protected $submit;


    public function __construct( $options = null )
        {

        $this->nombre = new ZendX_JQuery_Form_Element_AutoComplete( 'nombre' );
        $this->submit = new Zend_Form_Element_Submit( 'submit' );

        parent::__construct( $options );
        }


    private function _addContentElement()
        {
        $this->addElements(
                array(
                    $this->nombre ,
                    $this->submit )
        );
        }


    public function init()
        {
        parent::init();

        $this
                ->setMethod( 'post' )
                ->setAttrib( 'id' , 'frmSearchEquipoRequerido' )
                ->setAttrib( 'class' , 'zend_form' )
        ;

        $this->nombre->setLabel(
                $this->_translate->translate( 'nombre' )
        );
        $this->nombre->setAttrib( 'maxlength' , '50' );
        $this->nombre->setRequired( true );
        $this->nombre->addValidator(
                new Zend_Validate_StringLength(
                        array( 'min' => 1 , 'max' => 150 )
                )
        );
        $this->nombre->setJQueryParam(
                'source' ,
                '/admin/equiporequerido/searchequiporequerido/format/json' );

        $this->submit->setLabel(
                        $this->_translate->translate( 'buscar' )
                )
                ->setAttrib(
                        'class' , 'button'
                )

        ;


        $this->_addContentElement();
        }


    }
