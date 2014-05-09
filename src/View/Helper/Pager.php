<?php
/**
 * ABS Library
 *
 * @category   ABS_Library
 * @package    Views
 * @copyright  Copyright (c) 2008 Shvakin V. (http://a1p2m3.googlepages.com/)
 * @version    2.0
 */

class Zend_View_Helper_Pager {
    /**
     * The view object that created this helper object.
     * @var Zend_View
     */
    public $view;

    public function pager($pagerParams, $queryString='')
    {
        $html='';
        if ($queryString!=='') {
            $queryString='?'.$queryString;
        }
        $page=$pagerParams['page'];
        $min=$pagerParams['page']-10;
        $max=$pagerParams['page']+10;

        if ($min<1) {
            $min=1;
        }
        else {
            $html.='[0-'.($min-1).'] ';
        }

        if ($max>$pagerParams['count_pages']) {
            $max=$pagerParams['count_pages'];
        }
        for ($i=$min; $i<=$max; $i++)
        {
            if ($i!==$pagerParams['page']) {
                $html.=' '.$this->view->link($i, $this->view->url(array('page'=>$i)).$queryString);
            }
            else {
                $html.=" <b>$i</b>";
            }
        }

        if ($max!==$pagerParams['count_pages']) {
            $smax=$pagerParams['count_pages'];
            $html.=' ['.($max+1).'-'.$smax.']';
        }
        return $html;
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
