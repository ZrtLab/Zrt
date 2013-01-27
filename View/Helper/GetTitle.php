<?php

class Zrt_View_Helper_GetTitle {
    /**
     * The view object that created this helper object.
     * @var Zend_View
     */
    public $view;

    public function getTitle()
    {
       $title=$this->view->headTitle();
       $title=str_replace(array('<title>', '</title>'), '', $title);
       $titles=explode($this->view->headTitle()->getSeparator(), $title);
       return $titles[count($titles)-1];
    }


    /**
     * Set view object
     *
     * @param  Zend_View_Interface $view
     * @return Zend_View_Helper_DeclareVars
     */
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
        return $this;
    }
}