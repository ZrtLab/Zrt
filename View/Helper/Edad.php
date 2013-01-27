<?php


class Zrt_View_Helper_Edad
        extends Zend_View_Helper_Abstract
    {


    /**
     *
     * @todo POR CORREGIR
     * @param <type> $fechaNacimiento
     * @return <type>
     */
    public function Edad( $fechaNacimiento )
        {
        list($dia , $mes , $ano) = explode( "/" , $fechaNacimiento );
        $anoDiferencia = date( "Y" ) - $ano;
        $mesDiferencia = date( "m" ) - $mes;
        $diaDiferencia = date( "d" ) - $dia;
        if ( $diaDiferencia < 0 || $mesDiferencia < 0 ) $anoDiferencia--;
        return $anoDiferencia;
        }


    }