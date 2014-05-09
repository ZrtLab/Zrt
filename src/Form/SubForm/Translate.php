<?php


class Zrt_Form_SubForm_Translate
        extends Zrt_SubForm
    {

    protected $_data;
    protected $idioma;
    protected $idiomas_id;
    protected $entidades_id;
    protected $campo_id;
    protected $campo;
    protected $traducciones;


    public function __construct( $data )
        {
        if ( !empty( $data ) )
            {
            $this->_data = $data;
            }

        $this->entidades_id = new Zend_Form_Element_Hidden( 'entidades_id' );
        $this->campo_id = new Zend_Form_Element_Hidden( 'campo_id' );
        $this->campo = new Zend_Form_Element_Text( 'nombrecampo' );
        $this->idioma = new Zrt_Models_Bussines_Idioma();
        $this->traducciones = new Zrt_Models_Bussines_Traducciones();

        parent::__construct();
        }


    private function _setValues()
        {

        $this->entidades_id->setValue(
                $this->_data['entidad_id']
        );

        $this->campo_id->setValue(
                $this->_data['campo_id']
        );
        $this->campo->setValue(
                $this->_data['campo']
        );
        }


    private function _getValueTraduccion( $idioma_id )
        {

        $data = $this->traducciones->getTraduccionByEntidadCampoIdioma(
                $this->_data['entidad_id'] , $this->_data['campo_id'] ,
                $idioma_id
        );

        if ( is_object( $data ) )
            {
            return $data->texto;
            }

        return '';
        }


    private function _addCamposIdiomas()
        {
        $idiomas = $this->idioma->listar();
        foreach ( $idiomas as $idioma )
            {
            $texto = new Zend_Form_Element_Text(
                            $idioma->id
            );



            $texto->setLabel( $idioma->nombre );

            $texto->setValue(
                    $this->_getValueTraduccion( $idioma->id )
            );

            $this->addElement( $texto );
            }
        }


    public function init()
        {

        parent::init();

//        $this->texto->setLabel(
//                $this->_translate->translate(
//                        'texto'
//                )
//        );
        //$this->idioma->setValue( $this->_data['nomIdioma'] ) ;

        $this->campo->setLabel(
                $this->_translate->translate(
                        'campo'
                ) );
        $this->campo->setAttrib(
                'readonly' , "readonly"
        )
        ;

        $this->_setValues();
        $this->_addContentElement();
        $this->_addCamposIdiomas();
        }


    private function _addContentElement()
        {

        $this->addElement( $this->entidades_id );
        $this->addElement( $this->campo_id );
        $this->addElement( $this->campo );
        }


//    private function setDataValues()
//        {
//        $dataPagina = $this->_pagina->getByPageIdiomasPaises(
//                $this->_data['page_id'] , $this->_data['idioma_id'] ,
//                $this->_data['paises_id']
//        ) ;
//
//        if ( is_object( $dataPagina ) )
//            {
//            $this->titulo->setValue( $dataPagina->titulo ) ;
//            $this->body->setValue( $dataPagina->body ) ;
//            }
//
//
//        }

    }

