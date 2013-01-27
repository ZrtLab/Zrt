<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Zrt_Store_Cart_Abstract_StandardCart
        extends Zrt_Store_Cart_Abstract
    {

    static private $_instance = null;


    protected function __construct()
        {
        parent::__construct();
        }


    static public function getInstance()
        {
        if ( !self::$_instance instanceof self )
            {
            self::$_instance = new self();
            }
        return self::$_instance;
        }


    public function reset( $resetDatabase = false )
        {
        $this->_contents = new Zrt_Store_Cart_Item_Collection();
        $this->_total = 0;
        $this->_weight = 0;
        $sessionData = Zend_Registry::getInstance()->get( 'Zrt' );
        if ( isset( $sessionData->cartId ) )
            {
            unset( $sessionData->cartId );
            }
        }


    public function addCart( Zrt_Store_Cart_Item $item )
        {
        if ( $this->incart( $item->getId ) )
            {
            $this->updateQuantity( $item->getId() , $item->getQuantity() );
            }
        else
            {
            $this->_contents->addItem( $item->getId , $item );
            $this->cleanup();
            }
        }


    public function updateQuantity( $produtId , $quantity , $qtyFromPost = false )
        {
        $item = $this->findProducto( $productoId );
        if ( $item !== null )
            {
            $quantity = ($qtyFromPost === true) ? $quantity : $item->getQuantity() + $quantity;
            $item->setQuantity( $quantity );
            $this->cleanup();
            }
        }


    public function cleanup()
        {
        foreach ( $this->_contents->getIterator() as $key => $value )
            {
            if ( $this->getQuantity( $key ) < 1 )
                {
                $this->_contents->detach( $key );
                }
            }
        }


    public function countContents()
        {
        return ( int ) $this->_contents->count();
        }


    public function getQuantity( $productId )
        {
        if ( $this->inCart( $productId ) )
            {

            if ( ($item = $this->_contents->getItem( $productID ))
                    && ($item->getQuantity() > 0) )
                {
                return $item->getQuantity();
                }
            return 0;
            }
        else
            {
            return 0;
            }
        }


    public function inCart( $productId )
        {
        return $this->_contents->offsetExists( $productId );
        }


    public function has( $productId )
        {
        return $this->inCart( $productId );
        }


    public function findProducto( $productoId )
        {
        if ( $this->inCart( $productoId ) )
            {
            return $this->_contents->getItem( $productoId );
            }
        return null;
        }


    public function remove( $productId )
        {
        $product = $this->findProducto( $productoId );
        if ( $product !== null )
            {
            $this->_contents->detach( $productId );
            }
        }


    public function removeProductos( ArrayAccess $productIds )
        {
        if ( $productIds !== null )
            {
            for ( $iterator = $productIds->getIterator(); $iterator->valid();
                        $iterator->next() )
                {
                $this->remove( ( String ) $iterator->current() );
                }
            }
        }


    public function removeAll()
        {
        $this->reset();
        }


    public function getProducts()
        {
        $this->calculateTotals();
        return $this->_contents;
        }


    public function caculateTotals()
        {
        $this->_total = 0;
        $this->weight = 0;

        foreach ( $this->_contents->getIterator() as $productsId => $item )
            {
            $this->_weight = ($item->getQuantity() * $item->getWeight());
            $this->_total += $item->getImporte();
            }
        }


    public function getContents()
        {
        return $this->_contents;
        }


    public function getTotal()
        {
        return ( double ) $this->_total;
        }


    public function getWeight()
        {
        return ( double ) $this->_weight;
        }


    }

