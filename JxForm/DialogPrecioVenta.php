<?php


class Zrt_JxForm_DialogPrecioVenta
        extends ZendX_JQuery_Form
    {


    public function init()
        {
        $this->setAction(
                Zend_Controller_Front::getInstance()->getBaseUrl() . '/admin/equipo/saveprecio' 
                )
                ->setMethod( 'post' )
                ->setAttrib('class','zend_form')
                ->setAttrib('id','dialogPrecioVenta');


       /* $this->setDecorators( array(
            'FormElements' ,
            'Form' ,
            array( 'DialogContainer' , array(
                    'id' => 'tabContainer' ,
                    'style' => 'width: 600px;' ,
                    'title' => 'asignar precio a producto' ,
                    'JQueryParams' => array(
                        'tabPosition' => 'top' ,
                    ) ,
                ) ) ,
        ) );*/

        $id = new Zend_Form_Element_Hidden('id');
        
        
        $precioventa = new Zend_Form_Element_Text( 'precioventa' );
        $precioventa->setValue( 'precioventa' )
                ->setRequired( true )
                ->setDecorators( array(
                    'ViewHelper' ,
                    'Description' ,
                    'Errors' ,
                    array( 'HtmlTag' , array( 'tag' => 'dl' ) ) ) );

        $submit = new Zend_Form_Element_Submit( 'submit' );
        $submit->setLabel( 'Send your comment' )
                ->setDecorators( array(
                    'ViewHelper' ,
                    'Description' ,
                    'Errors' ,
                    array( 'Description' , array( 'escape' => false , 'tag' => 'span' ) ) ,
                    array( 'HtmlTag' , array( 'tag' => 'dl' ) ) ) )
                ->setDescription(
                        'or <a href="/index/index/send/false">Cancel</a>' 
                        );
        $this->addElements( array( $precioventa,  $submit, $id ) );
        }


    }