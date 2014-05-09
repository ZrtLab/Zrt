<?php


class Zrt_Form_SubForm_ContentCountry
        extends Zrt_SubForm
    {

    protected $idioma_id;
    protected $titulo;
    protected $body;
    protected $page_id;
    protected $paises_id;
    protected $_data;
    protected $_pagina;


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
        $this->titulo = new Zend_Form_Element_Text( 'titulo' );
        $this->body = new Zrt_Form_Element_Ckeditor( 'body' );

        parent::__construct();
        }


    public function init()
        {
        parent::init();


        $this->titulo->setRequired();
        $this->titulo->setLabel(
                $this->_translate->translate(
                        'titulo'
                )
        );


        //$this->body->setRequired();
        $this->body->setLabel(
                $this->_translate->translate(
                        'cuerpo'
                ) );
        $this->body->setAttrib( 'COLS' , '40' );
        $this->body->setAttrib( 'ROWS' , '4' );

        $this->setDataValues();
        $this->addContentElement();
        }


    protected function addContentElement()
        {
        $this->addElement( $this->paises_id );
        $this->addElement( $this->page_id );
        $this->addElement( $this->idioma_id );
        $this->addElement( $this->titulo );
        $this->addElement( $this->body );
        }


    private function setDataValues()
        {

        $this->page_id->setValue( $this->_data['page_id'] );

        $this->titulo->setValue( $this->_data['titulo'] );

        $this->paises_id->setValue( $this->_data['paises_id'] );

        $this->idioma_id->setValue( $this->_data['idioma_id'] );


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

