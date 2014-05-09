<?php

/**
 * Zrt
 *
 * @category Zrt
 * @copyright Copyright (c) 2010 Jamie Talbot (http://jamietalbot.com)
 * @version $Id: Debug.php 69 2010-09-08 12:32:03Z jamie $
 */
/**
 * Debug functionality
 *
 * @defgroup Zrt_Debug Zrt Debug
 */

/**
 * Provides useful debugging tools.
 *
 * @ingroup Zrt_Debug
 */
class Zrt_Debug
    {

    public static function print_r($data)
        {
        echo "<xmp>" . print_r( $data , true ) . "</xmp>";

        }

    }
