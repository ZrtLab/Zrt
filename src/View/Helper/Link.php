<?php


/**
 * ABS Library
 *
 * @category   ABS_Library
 * @package    Views
 * @copyright  Copyright (c) 2008 Shvakin V. (http://a1p2m3.googlepages.com/)
 * @version    2.0
 */
class Zrt_View_Helper_Link
    {


    public function link( $title , $href )
        {
        return "<a href=\"$href\" alt=\"$title\">$title</a>";
        }


    }