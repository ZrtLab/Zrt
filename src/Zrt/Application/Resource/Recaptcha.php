<?php

namespace Zrt\Application\Resource;

class Recaptcha extends Zend_Application_Resource_ResourceAbstract
{

    public function init()
    {
        $options = $this->getOptions();
        Zend_Registry::set('recaptcha', $options);
    }

}
