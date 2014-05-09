<?php

class Zrt_Validate_Captcha
        extends Zend_Validate_Abstract
    {

    const NOT_MATCH = 'notMatch';

    protected $_messageTemplates = array(
        self::NOT_MATCH => 'Captcha no valido'
    );

    public function isValid($value , $context = null)
        {

        $captchaId = $captcha['id'];
// And here's the user submitted word...
        $captchaInput = $captcha['input'];
// We are accessing the session with the corresponding namespace
// Try overwriting this, hah!
        $captchaSession = new Zend_Session_Namespace(
                        'Zend_Form_Captcha_' . $captchaId
        );
// To access what's inside the session, we need the Iterator
// So we get one...
        $captchaIterator = $captchaSession->getIterator();

        Zend_Debug::dump( $captchaIterator );exit();
// And here's the correct word which is on the image...

        $captchaWord = $captchaIterator['word'];


        $value = (string) $value;

        $this->_setValue( $value );

        if ( is_array( $context ) ) {
            if ( isset( $context['id'] )
                    && ($value == $context['id']) )
                {
                return true;
                }
            } elseif ( is_string( $context ) && ($value == $context) ) {
            return true;
            }

        $this->_error( self::NOT_MATCH );

        return false;
        }

    }
