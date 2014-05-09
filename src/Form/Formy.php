<?php

class Zrt_Form_Formy
        extends Zrt_Form
    {

    protected static $_standardElementDecorator = array(
        array( 'ViewHelper' ) ,
        array( 'Label' , array(
                'separator' => ' '
            ) ) ,
        array( 'Description' , array(
                'tag' => 'span' ,
                'class' => 'element-description-append' ,
                'placement' => 'append' )
        ) ,
        array( 'Errors' ) ,
        array( 'HtmlTag' , array( 'tag' => 'div' ) ) ,
    );
    protected static $_standardElementDecoratorAppendDescription = array(
        array( 'Description' , array( 'tag' => 'span' ,
                'class' => 'element-description-prepend' ,
                'placement' => 'prepend' ) ) ,
        array( 'ViewHelper' ) ,
        array( 'Label' , array( 'separator' => ' ' , ) ) ,
        array( 'Errors' ) ,
        array( 'HtmlTag' , array( 'tag' => 'div' ) ) ,
    );
    protected static $_standardElementDecoratorClearRight = array(
        array( 'ViewHelper' ) ,
        array( 'Label' , array( 'separator' => ' ' , ) ) ,
        array( 'Description' , array( 'tag' => 'span' ,
                'class' => 'element-description-append' ,
                'placement' => 'append' ) ) ,
        array( 'Errors' ) ,
        array( 'HtmlTag' , array( 'tag' => 'div' , 'class' => 'clearRight' ) ) ,
    );
    protected static $_standardElementDecoratorClearLeft = array(
        array( 'ViewHelper' ) ,
        array( 'Label' , array( 'separator' => ' ' , ) ) ,
        array( 'Description' , array( 'tag' => 'span' ,
                'class' => 'element-description-append' ,
                'placement' => 'append' ) ) ,
        array( 'Errors' ) ,
        array( 'HtmlTag' , array( 'tag' => 'div' , 'class' => 'clearLeft' ) ) ,
    );

    /**
     *
     * Remeber to set 'separator' => '' into the element
     * @var array
     */
    protected static $_multiCheckboxElementDecorator = array(
        array( 'ViewHelper' ) ,
        array( 'Label' , array( 'separator' => ' ' , 'tag' => 'span' ) ) ,
        array( 'Description' , array( 'tag' => 'span' ,
                'class' => 'element-description-append' ,
                'placement' => 'append' ) ) ,
        array( 'Errors' ) ,
        array( 'HtmlTag' , array( 'tag' => 'div' , 'class' => 'multiCheckbox' ) ) ,
    );
    protected static $_hiddenElementDecorator = array(
        array( 'ViewHelper' )
    );
    protected static $_submitElementDecorator = array(
        array( 'ViewHelper' ) ,
        array( 'HtmlTag' , array( 'tag' => 'p' , 'class' => 'element-submit' ) ) ,
    );
    protected static $_buttonElementDecorator = array(
        array( 'ViewHelper' ) ,
        array( 'HtmlTag' , array( 'tag' => 'p' , 'class' => 'element-button' ) ) ,
    );

    public function __construct($options = null)
        {
        parent::__construct( $options );

//$this->addElementPrefixPath('ZendY_Form_Decorator','ZendY/Form/Decorator','decorator');
        }

    /**
     * Load the default decorators
     *
     * @return void
     */
    public function loadDefaultDecorators()
        {

        if ( !$this->loadDefaultDecoratorsIsDisabled() ) {

//$this->removeDecorator('DtDdWrapper');
//$this->removeDecorator('DlWrapper');

            $this->clearDecorators()
                    ->setAttrib( 'accept-charset' , 'UTF-8' )
                    ->addDecorator( 'FormElements' )
//                    ->addDecorator( 'HtmlTag' ,
//                                    array( 'tag' => '' ,
//                        'class' => 'zendy_formContent'
//                            )
//                    )
                    ->addDecorator( 'Form' )
                    ->setAttrib( 'class' , 'zendy_form' )
            ;
            }

        foreach ( $this->getDisplayGroups() as $group ) {

            if ( $group->loadDefaultDecoratorsIsDisabled() ) continue;

            $group->clearDecorators();

            $group->addDecorators(
                    array(
                        array( 'FormElements' ) ,
                        array( 'Description' , array( 'tag' => 'p' ,
                                'class' => 'group-description' ,
                                'placement' => 'prepend' ) ) ,
                        new Zend_Form_Decorator_Fieldset() ,
                    )
            );
            }

        foreach ( $this->getElements() as $element ) {

            if ( $element->loadDefaultDecoratorsIsDisabled() ) continue;

            switch ( $element->getType() ) {

                case 'Zend_Form_Element_Hidden':
                    $element->setDecorators(
                            self::$_hiddenElementDecorator
                    );
                    break;
                case 'Zend_Form_Element_Submit':
                    $element->setDecorators(
                            self::$_submitElementDecorator
                    );
                    break;
                case 'Zend_Form_Element_Button':
                    $element->setDecorators(
                            self::$_buttonElementDecorator
                    );
                    break;
                case 'Zend_Form_Element_Radio':
                case 'Zend_Form_Element_MultiCheckbox': $element->setDecorators(
                            self::$_multiCheckboxElementDecorator
                    );
                    break;
                case 'Zend_Form_Element_Select':
                case 'Zend_Form_Element_Text':
                default: $element->setDecorators(
                            self::$_standardElementDecorator
                    );
                }
            }

        return $this;
        }

    }
