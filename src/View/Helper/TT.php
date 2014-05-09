<?php


/**
 * ABS Library
 *
 * @category   ABS_Library
 * @package    Views
 * @copyright  Copyright (c) 2008 Shvakin V. (http://a1p2m3.googlepages.com/)
 * @version    2.0
 */
class Zrt_View_Helper_TT
    {

    /**
     * The view object that created this helper object.
     * @var Zend_View
     */
    public $view;


    public function tT( $table_name , $value )
        {
        $table = $this->view->thesaurusTables[$table_name];
        if ( !is_null( $table ) )
            {
            return ($this->view->thesaurus->getTerm( $table , $value ));
            }
        else
            {
            return $value;
            }
        }


    /**
     * Set view object
     *
     * @param  Zend_View_Interface $view
     * @return Zend_View_Helper_DeclareVars
     */
    public function setView( Zend_View_Interface $view )
        {
        $this->view = $view;
        return $this;
        }


    }