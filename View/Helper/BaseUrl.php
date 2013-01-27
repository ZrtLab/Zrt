<?php
/**
 * ABS Library
 *
 * @category   ABS_Library
 * @package    Views
 * @copyright  Copyright (c) 2008 Shvakin V. (http://a1p2m3.googlepages.com/)
 * @version    2.0
 */

class Zrt_View_Helper_BaseUrl {
    public function baseUrl()
    {
       $url=Zend_Controller_Front::getInstance()->getBaseUrl();
       if ($url==='' or is_null($url)) {
           $url='http://'.$_SERVER['SERVER_NAME'];
           if ($_SERVER['SERVER_PORT']!=='80')
           {
               $url.=':'.'SERVER_PORT';
           }
       }
        return ($url);
    }
}


