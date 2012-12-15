<?php

class Zrt_Application_Resource_View extends Zend_Application_Resource_ResourceAbstract
{

    protected $_view;
    protected $_config;

    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->_config = Zrt_DI_Container::get('ConfigObject');
    }

    public function init()
    {
        return $this->getView();
    }

    public function getView()
    {

        defined('MEDIA_URL')
            || define('MEDIA_URL', $this->_config->app->mediaUrl);
        defined('ELEMENTS_URL')
            || define('ELEMENTS_URL', $this->_config->app->elementsUrl);
        defined('SITE_URL')
            || define('SITE_URL', $this->_config->app->siteUrl);

        if (null === $this->_view) {

            $options = $this->getOptions();
            $view = new Zend_View();
            $view->doctype($options['doctype']);
            $view->headTitle($options['title']);
            $view->headMeta()
                ->appendName('keywords', 'limesoft,cms');

            $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
            $viewRenderer->setView($view);

            $this->_view = $view;
        }

        return $this->_view;
    }

}
