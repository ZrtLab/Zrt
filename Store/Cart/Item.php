<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Zrt_Store_Cart_Item
    {

    private $_product = null;
    private $_quantity = 0;
    private $_subTotal = null;


    public function __construct( Zrt_Models_Bussines_Equipo $product = null ,
                                 $qty = null )
        {
        $this->_product = $product;
        $this->_quantity = ( int ) $qty;
        $this->_calculateImporte();
        }


    public function getProduct()
        {
        return $this->_product;
        }


    public function setProduct( Zrt_Models_Bussines_Equipo $product )
        {
        $this->_product = $product;
        $this->_calculateImporte();
        }


    public function getId()
        {
        return $this->_product->getId();
        }


    public function setId( $value )
        {
        $this->_product->setId( ( int ) $value );
        }


    public function getName()
        {
        return $this->_product->getName();
        }


    public function setName( $value )
        {
        $this->_product->setName( $value );
        }


    public function getPrice()
        {
        return $this->_product->getPrice();
        }


    public function setPrice( $value )
        {
        $this->_product->setPrice( ( double ) $value );
        }


    public function getQuantity()
        {
        return $this->_quantity;
        }


    public function setQuantity( $value )
        {
        $this->_quantity = ( int ) $value;
        $this->_caculateImporte();
        }


    public function getWeight()
        {
        return $this->_product->getWeight();
        }


    public function setWeight()
        {
        $this->_product->setWeight( ( double ) $value );
        }


    public function _calculateImporte()
        {
        $this->getSubTotal();
        }


    public function getImporte()
        {
        return $this->_subTotal;
        }


    public function getSubTotal()
        {
        if ( $this->getPrice() != 0 && null !== $this->getPrice() )
            {
            $this->setSubtotal( $this->getQuantity() * $this->getPrice() );
            return $this->_subTotal;
            }
        return 0;
        }


    public function setSubTotal( $value )
        {
        $this->_subTotal = ( double ) $value;
        }


    }

