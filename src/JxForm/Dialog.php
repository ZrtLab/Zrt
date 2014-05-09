<?php


class Zrt_JxForm_Dialog
        extends ZendX_JQuery_Form
    {

    protected $spinner1;


    private function _addSetDecorators()
        {
        $this->setDecorators( array(
            'FormElements' ,
            'Form' ,
            array( 'DialogContainer' , array(
                    'id' => 'tabContainer' ,
                    'style' => 'width: 600px;' ,
                    'jQueryParams' => array(
                        'tabPosition' => 'top'
                    ) ,
                ) ) ,
        ) );
        }


    private function _setAttribs()
        {
        $this->spinner1->setJQueryParams( array( 'min' => 0 , 'max' => 1000 , 'start' => 100 ) );
        }


    public function __construct( $options = null )
        {
        $this->spinner1 = new ZendX_JQuery_Form_Element_Spinner(
                        "spinner1" , array(
                    'label' => 'Spinner:' , 'attribs' => array( 'class' => 'flora' )
                        )
        );

        parent::__construct( $options );
        }


    public function loadDefaultDecorators()
        {
        
        }


    public function init()
        {
        $this->_addSetDecorators();
        $this->_setAttribs();
        $this->addElement( $this->spinner1 );

        parent::init();
        }


    }