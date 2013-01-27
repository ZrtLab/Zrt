<?php

/**
 * Zrt PHP Library
 *
 * @category Zrt
 * @copyright Copyright (c) 2008-2010 Jamie Talbot (http://jamietalbot.com)
 * @version $Id: jQuery.php 69 2010-09-08 12:32:03Z jamie $
 */


/**
 * JQuery helper that adds plugin registering functionality.
 *
 * @class Zrt_View_Helper_JQuery
 * @ingroup Zrt_View_Helpers
 */
class Zrt_View_Helper_JQuery
        extends ZendX_JQuery_View_Helper_JQuery
    {


    /**
     * Adds a plugin to the include stack.
     *
     * @param string $plugin
     * @param string $path
     *
     * @return Zrt_View_Helper_JQuery
     */
    public function addPlugin( $plugin , $path = 'plugins' )
        {
        $path = Zrt_Resource::version( "js/$path/$plugin.js" );
        $this->addJavascriptFile( $path );
        return $this;


        }


    /**
     * Adds a validation definition to the include stack.
     * @param string $plugin
     * @param string $path
     * @return Zrt_View_Helper_JQuery
     */
    public function addValidation( $model , $domain = 'main' ,
                                   $path = 'validation' )
        {
        $path = Zrt_Resource::version( "js/$path/$model.js" );
        $this->addJavascriptFile( $path );
        $this->addJavascript( "Zrt.Validation.Map['$domain'] = '$model'" );
        return $this;


        }


    /**
     * Enables jQuery and sets it to use the local version.
     */
    public function enable()
        {
        $this->setLocalPath( Zrt_Resource::version( "js/jquery.js" ) )
                ->setUiLocalPath( Zrt_Resource::version( "js/jquery-ui.js" ) )
                ->enable();


        }


    }
