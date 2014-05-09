<?php


class Zrt_View_Helper_Soles
        extends Zend_View_Helper_HtmlElement
    {

    const SYMBOL = "S/.";
    const DECIMALES = 2;
    const DECIMALES_SEP = '.';
    const MILES_SEP = '';


    /**
     * @param <type> $n Cantaidad
     * @return <type> Texto formateado
     */
    public function Soles( $n = 0 )
        {
        $numero_formateado = number_format( $n , self::DECIMALES ,
                                            self::DECIMALES_SEP ,
                                            self::MILES_SEP );
        return sprintf( "%s %s" , self::SYMBOL , $numero_formateado );
        }


    }