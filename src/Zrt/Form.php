<?php

abstract class Zrt_Form
        extends Zend_Form
{

    protected $_translate ;
    protected $_recaptchaKeys ;
    protected $_recaptcha ;
    protected $_captcha ;

    const SALT ='s3cr3t%&$$$$@@on9!!!' ;

    private function _addHash()
    {
        $this->addElement( 'hash' , 'csrf_token' ,
                array( 'salt' => get_class( $this ) . self::SALT )
        ) ;

    }

    public function __construct($options = null)
    {

        $this->_captcha =
                array( 'captcha' => 'Image' ,
                    'wordLen' => 4 ,
                    'timeout' => 300 ,
                    'width' => 120 ,
                    'height' => 50 ,
                    'height' => 50 ,
                    'DotNoiseLevel' => 5 ,
                    'LineNoiseLevel' => 2 ,
                    'font' => APPLICATION_PATH . '/font/IMPACTED.TTF' ,
                    'imgDir' => APPLICATION_PUBLIC . DS . 'captcha' . DS ,
                    'imgUrl' => '/captcha/' , ) ;

        $this->_recaptchaKeys = Zend_Registry::get( 'config.recaptcha' ) ;

        $this->_recaptcha = new Zend_Service_ReCaptcha(
                        $this->_recaptchaKeys['pubkey'] ,
                        $this->_recaptchaKeys['privkey']
                ) ;

        $this->setMethod( 'post' ) ;

        $this->_translate = Zend_Registry::get( 'Zend_Translate' ) ;

        parent::__construct( $options ) ;

    }

    public function loadDefaultDecorators()
    {
        if ( $this->loadDefaultDecoratorsIsDisabled() )
            return ;

        $decorators = $this->getDecorators() ;
        if ( empty( $decorators ) ) {
            $this->addDecorator( 'FormElements' )
                    ->addDecorator( 'HtmlTag' ,
                            array(
                                'tag' => 'dl' , 'class' => 'zend_forma'
                            )
                    )
                    ->addDecorator( 'Form' )
            ;
        }

    }

    public function init()
    {
        parent::init() ;

    }

}
