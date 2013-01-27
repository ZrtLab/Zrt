<?php


class Zrt_View_Helper_Currency
        extends Zend_View_Helper_HtmlElement
    {

    protected $producto;


    private function _span()
        {
        $html = '<span class="device-description-field">';
        $html .= $this->translate( 'Price' );
        $html .= '</span">';
        return $html;
        }


    public function Currency( $producto )
        {
        $html = "";
        $this->producto = $producto;

        if ( $this->producto->monedaid > 0 && $this->producto->precioventa > 0 )
            {

            if ( !is_null( $producto->precioventa ) )
                {

                $html.= $this->_span();
                }
            }
        }


    }