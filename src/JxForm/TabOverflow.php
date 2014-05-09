<?php


class Zrt_JxForm_TabOverflow
        extends ZendX_JQuery_Form
    {


    public function init()
        {
        $this->setAction(
                        Zend_Controller_Front::getInstance()->getBaseUrl() . '/index/index'
                )
                ->setMethod( 'post' )
                ->setAttrib( 'class' , 'zend_form' );



        $this->setDecorators( array(
            'FormElements' ,
            'Form' ,
            array( 'AccordionContainer' , array(
                    'id' => 'tabContainer' ,
                    'style' => 'width: 600px;' ,
                    'jQueryParams' => array(
                        'alwaysOpen' => false ,
                        'animated' => "easeslide"
                    ) ,
                ) ) ,
            'Form'
        ) );

//        $this->setDecorators( array(
//            'FormElements' ,
//            'Form' ,
//            array( 'DialogContainer' , array(
//                    'id' => 'tabContainer' ,
//                    'style' => 'width: 600px;' ,
//                    'title' => 'Send a private message to Kalle' ,
//                    'JQueryParams' => array(
//                        'tabPosition' => 'top' ,
//                    ) ,
//                ) ) ,
//        ) );

        $topic = new Zend_Form_Element_Text( 'topic' );
        $topic->setValue( 'topic' )
                ->setRequired( true )
                ->setValidators( array( 'validators' => array(
                        'validator' => 'StringLength' ,
                        'options' => array( 1 , 15 )
                    ) ) )
                ->setDecorators( array(
                    'ViewHelper' ,
                    'Description' ,
                    'Errors' ,
                    array( 'HtmlTag' , array( 'tag' => 'dl' ) ) ) );

        $textarea = new Zend_Form_Element_Textarea( 'textarea' );
        $textarea->setValue( 'post a comment' )
                ->setAttribs( array(
                    'rows' => 4 ,
                    'cols' => 20
                ) )
                ->setRequired( true )
                ->setValidators( array( 'validators' => array(
                        'validator' => 'StringLength' ,
                        'options' => array( 1 , 15 )
                    ) ) )
                ->setDecorators( array(
                    'ViewHelper' ,
                    'Description' ,
                    'Errors' ,
                    array( 'HtmlTag' , array( 'tag' => 'dl' ) ) ) );

        $submit = new Zend_Form_Element_Button( 'submit' );
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
        $this->addElements( array( $topic , $textarea , $submit ) );
        }


    }