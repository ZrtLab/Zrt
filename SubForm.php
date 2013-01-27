<?php


abstract class Zrt_SubForm
        extends Zend_Form_SubForm
    {

    protected $_translate;


    public function __construct( $options = null )
        {
        $this->setMethod( 'post' );

        $this->_translate = Zend_Registry::get( 'Zend_Translate' );

//        $this->addPrefixPath( 'Zrt_Form_Tabular_Element'
//                , 'Zrt/Form/Tabular/Element/' , Zend_Form::ELEMENT );
//
//        $this->addPrefixPath( 'Zrt_Form_Tabular_Decorator'
//                , 'Zrt/Form/Tabular/Decorator/' , Zend_Form::DECORATOR );

        parent::__construct();
        }


//    public function loadDefaultDecorators()
//        {
//        if ( $this->loadDefaultDecoratorsIsDisabled() ) return;
//
//        $decorators = $this->getDecorators();
//
//        if ( empty( $decorators ) )
//            {
//            $this->addDecorator( 'FormElements' )
//                    ->addDecorator( 'HtmlTag' ,
//                                    array(
//                        'tag' => 'table' , 'class' => 'zend_form'
//                            )
//                    )
//                    ->addDecorator( 'Form' )
//            ;
//            }
//        }


    public function init()
        {
        parent::init();
        }


    }

