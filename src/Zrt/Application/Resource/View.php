<?php

namespace Zrt\Application\Resource;

class View extends Zend_Application_Resource_View
{

    public function getView()
    {
        $this->_view = parent::getView();

        if (null === $this->_view) {

            $options = $this->getOptions();

            $view = new Zend_View();

            $view->headTitle($options['title']);
            $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
            $viewRenderer->setView($view);

            $this->_view = $view;
        }

        return $this->_view;
    }

}
