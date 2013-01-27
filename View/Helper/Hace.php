<?php


class Zrt_View_Helper_Hace
        extends Zend_View_Helper_HtmlElement
    {


    /**
     *
     * @param string $t Texto de una fecha
     * @return string cálculo del tiempo transcurrido en la unidad
     * de tiempo más apropiada
     */
    public function Hace( $t )
        {
        return Zrt_Tools::hace( $t , '%s' );
        }


    }