<?php

class Zrt_Application_Resource_Recaptcha extends Zend_Application_Resource_ResourceAbstract
{

    public function init()
    {
        $options = $this->getOptions();
        Zend_Registry::set('recaptcha', $options);
    }

}
