<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Zrt_Store_Cart
    {

    protected $id;
    protected $nombre;
    protected $precio;
    protected $cantidad;
    protected $equipo_has_formaPago;
    protected $codemoneda;
    protected $codegoogle;
    protected $currency;
    private $equipo;


    public function setCurrency( $value )
        {
        $this->currency = $value;
        }


    public function getCurrency()
        {
        return $this->currency;
        }


    public function __construct( $equipo , $currency = null )
        {

        if ( isset( $currency ) )
            {
            $this->currency = $currency;
            }


        $this->equipo = $equipo;

        $this->_addData();
        }


    private function _addData()
        {
        $this->id = $this->equipo->id;

        $this->codemoneda =
                isset( $this->currency->code ) ?
                $this->currency->code :
                $this->equipo->code;

        $this->codegoogle = isset( $this->currency->codeGoogle ) ?
                $this->currency->codeGoogle :
                $this->equipo->codegoogle;

        $valor = $this->equipo->precioventa;

        if ( isset( $this->currency ) )
            {
            $valor =
                    Zrt_Service_Finance::currency(
                            $this->equipo->codegoogle , $this->currency->codeGoogle ,
                            $valor
            );
            }
        $this->precio = $valor;


        $this->nombre = $this->equipo->nombre;
        $this->cantidad = 1;
        $this->equipo_has_formaPago = 0;
        }


    public function setCodeGoogle( $value )
        {
        $this->codegoogle = $value;
        }


    public function getCodeGoogle()
        {
        return $this->codegoogle;
        }


    public function setCodeMoneda( $value )
        {
        $this->codemoneda = $value;
        }


    public function getCodeMoneda()
        {
        return $this->codemoneda;
        }


    public function setNombre( $value )
        {
        $this->nombre = $value;
        }


    public function getNombre()
        {
        return $this->nombre;
        }


    public function getId()
        {
        return $this->id;
        }


    public function setId( $id )
        {
        $this->id = $id;
        }


    public function getPrecio()
        {
        return $this->precio;
        }


    public function setPrecio( $precio )
        {
        $this->precio = $precio;
        }


    public function getCantidad()
        {
        return $this->cantidad;
        }


    public function setCantidad( $cantidad )
        {
        $this->cantidad = $cantidad;
        }


    public function getEquipo_has_formaPago()
        {
        return $this->equipo_has_formaPago;
        }


    public function setEquipo_has_formaPago( $equipo_has_formaPago )
        {
        $this->equipo_has_formaPago = $equipo_has_formaPago;
        }


    }

?>
