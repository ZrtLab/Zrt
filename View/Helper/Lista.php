<?php


class Zrt_View_Helper_Lista
        extends Zend_View_Helper_HtmlElement
    {


    /**
     * @param array $a Array con items de la lista
     * @return string HTML de la lista usando tags <ol> y <li>
     */
    public function Lista( array $a = array( ) )
        {
        if ( !( bool ) count( $a ) )
            {
            return "(vacío)";
            }

        $t = "";
        foreach ( $a as $value )
            {
            $t .= sprintf( "<li>%s</li>" , $value );
            }
        return sprintf( "<ol>%s</ol>" , $t );
        }


    }