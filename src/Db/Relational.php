<?php


class Zrt_Db_Relational
        implements Zrt_Db_Interface
    {


    public static function factory( $adapter , $config = array( ) )
        {
        $adapter = Zend_Db::factory( $adapter , $config );

        if ( Zrt_Db::hasProfiling() )
            {
            $adapter->setProfiler( Zrt_Db::getProfiler() );
            }

        $adapter->setFetchMode( Zend_Db::FETCH_OBJ );
        return $adapter;


        }


    }


?>