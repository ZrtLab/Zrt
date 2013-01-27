<?php


class Zrt_Db_Document
        implements Zrt_Db_Interface
    {


    public static function factory( $adapter , $config = array( ) )
        {
        if ( $config instanceof Zend_Config )
            {
            $config = $config->toArray();
            }

        if ( !is_array( $config ) )
            {
            throw new Zrt_Exception( 'Adapter parameters must be in an array or a Zend_Config object' );
            }

        if ( !is_string( $adapter ) || empty( $adapter ) )
            {
            throw new Zrt_Exception( 'Adapter name must be specified in a string' );
            }

        // Get adapter class name.
        $adapterNamespace = 'Zrt_Db_Document_Adapter';
        if ( isset( $config['adapterNamespace'] ) )
            {
            if ( $config['adapterNamespace'] != '' )
                {
                $adapterNamespace = $config['adapterNamespace'];
                }
            unset( $config['adapterNamespace'] );
            }

        $adapterName = $adapterNamespace . '_';
        $adapterName .= str_replace( ' ' , '_' ,
                                     ucwords( str_replace( '_' , ' ' ,
                                                           strtolower( $adapter ) ) ) );

        // Create the new adapter
        return new $adapterName( $config );


        }


    }


?>