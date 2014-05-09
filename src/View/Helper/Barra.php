<?php


/**
 * Description of Barra
 *
 * @author eanaya
 */
class Zrt_View_Helper_Barra
        extends Zend_View_Helper_Abstract
    {


    public function Barra( $n = 0 )
        {
        $n = ( int ) $n;
        if ( $n < 0 || $n > 100 )
            {
            $n = 0;
            }
        if ( $n >= 0 && $n < 35 )
            {
            $color = "red";
            }
        else if ( $n >= 35 && $n <= 75 )
            {
            $color = "yellow";
            }
        else
            {
            $color = "green";
            }

        $texto = '
        <div style="border: 1px solid black; width: 120px;height: 20px;">
            <div style="float: left; background: %s; width: %d%%; height: 20px;">
                <span>%d%%</span>
            </div>
        </div>
        ';
        return sprintf( $texto , $color , $n , $n );
        }


    }