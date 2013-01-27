<?php


class Zrt_Data_Marshal_CouchDocument
        implements Zrt_Data_Marshal_Interface
    {

    protected static $_marshalledClass = 'Zrt_Db_Document_Couch';


    public static function provides()
        {
        return self::$_marshalledClass;


        }


    public static function provide( $object )
        {
        if ( !$object instanceof Zrt_Db_Document_Couch )
            {
            throw new Zrt_Exception( "Must implement Zrt_Db_Document_Couch" );
            }
        $data = $object->toArray();
        if ( array_key_exists( 'doc' , $data ) )
            {
            $data = $data['doc'];
            }
        return $data;


        }


    public static function save( array $data , $object )
        {
        if ( !$object instanceof Zrt_Db_Document_Couch )
            {
            throw new Zrt_Exception( "Must implement Zrt_Db_Document_Couch" );
            }
        return $object->setFromArray( $data )->save();


        }


    }


?>