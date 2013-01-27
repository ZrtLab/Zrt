<?php


class Zrt_Data_Formatter_Json
        implements Zrt_Data_Formatter_Interface
    {


    /**
     * Returns the data formatted as Json.
     * 
     * @param Zrt_Data_Interface $object
     * @return string
     */
    public static function format( Zrt_Data_Interface $object )
        {
        return Zend_Json::encode( $object->toArray() );


        }


    }