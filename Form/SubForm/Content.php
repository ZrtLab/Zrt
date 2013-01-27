<?php


class Zrt_Form_SubForm_Content
        extends Zrt_SubForm
    {

    protected $idioma;
    protected $idioma_id;
    protected $titulo;
    protected $body;
    protected $page_id;
    protected $paises_id;
    protected $_data;
    protected $_pagina;


    protected function _setGroup()
        {
        $this->addDisplayGroup( array( 'page_id' , 'paises_id' ,'idiomas_id' ) ,
                                'grouphidden' , array( "legend" => "hidden" ) );

        }


    public function __construct( $data )
        {
        if ( !empty( $data ) )
            {
            $this->_data = $data;
            }
        $this->_pagina = new Zrt_Models_Bussines_Pagina();

        $this->page_id = new Zend_Form_Element_Hidden( 'page_id' );
        $this->paises_id = new Zend_Form_Element_Hidden( 'paises_id' );
        $this->idioma_id = new Zend_Form_Element_Hidden( 'idiomas_id' );
        $this->idioma = new Zend_Form_Element_Text( 'idioma' );
        $this->titulo = new Zend_Form_Element_Text( 'titulo' );
        $this->body = new Zrt_Form_Element_Ckeditor( 'body' );

        parent::__construct();
        }


    public function init()
        {
        parent::init();

        $this->page_id->setValue( $this->_data['page_id'] );

        $this->paises_id->setValue( $this->_data['paises_id'] );

        $this->idioma_id->setValue( $this->_data['idioma_id'] );


        //$this->titulo->setRequired();
        $this->titulo->setLabel(
                $this->_translate->translate(
                        'titulo'
                )
        );
//        $this->titulo->addValidator(new Zend_Validate_StringLength(
//                        array(
//                            'min' => 5
//                            ,
//                            'max' => 600)
//                )
//        );


        $this->idioma->setValue( $this->_data['nomIdioma'] );

        $this->body->setLabel(
                $this->_translate->translate(
                        'cuerpo'
                ) );
        $this->body->setAttrib( 'cols' , '10' );
        $this->body->setAttrib( 'rows' , '4' );

        $this->setDataValues();
        $this->addContentElement();
        $this->_setGroup();
        }


    protected function addContentElement()
        {
        $this->addElement( $this->paises_id );
        $this->addElement( $this->page_id );
        $this->addElement( $this->idioma_id );
        $this->addElement( $this->idioma );
        $this->addElement( $this->titulo );
        $this->addElement( $this->body );
        }


    private function setDataValues()
        {
        $dataPagina = $this->_pagina->getByPageIdiomasPaises(
                $this->_data['page_id'] , $this->_data['idioma_id'] ,
                $this->_data['paises_id']
        );

        if ( is_object( $dataPagina ) )
            {
            $this->titulo->setValue( $dataPagina->titulo );
            $this->body->setValue( $dataPagina->body );
            }
        }


    }

