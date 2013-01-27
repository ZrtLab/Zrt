<?php


class Zrt_Data_Collection
        implements Iterator ,
                   Countable ,
                   ArrayAccess
    {

    protected $_objectClass = 'Zrt_Data_Object';
    protected $_objects = array( );


    public function __construct( $objects )
        {
        foreach ( $objects as $object )
            {
            $this->_objects[] = new $this->_objectClass( $object );
            }


        }


    public function first()
        {
        return ($this->_objects) ? $this->_objects[0] : null;


        }


    public function count()
        {
        return count( $this->_objects );


        }


    public function current()
        {
        return current( $this->_objects );


        }


    public function key()
        {
        return key( $this->_objects );


        }


    public function next()
        {
        return next( $this->_objects );


        }


    public function rewind()
        {
        return reset( $this->_objects );


        }


    public function valid()
        {
        return (false !== $this->current());


        }


    public function offsetSet( $offset , $value )
        {
        $this->_objects[$offset] = $value;


        }


    public function offsetExists( $offset )
        {
        return isset( $this->_objects[$offset] );


        }


    public function offsetUnset( $offset )
        {
        unset( $this->_objects[$offset] );


        }


    public function offsetGet( $offset )
        {
        return isset( $this->_objects[$offset] ) ? $this->_objects[$offset] : null;


        }


    public function __call( $method , $args )
        {
        foreach ( $this->_objects as $object )
            {
            call_user_func_array( array(
                $object ,
                $method
                    ) , $args );
            }


        }


    }


?>