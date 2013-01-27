<?php


/**
 * Allows only fields beginning with d to be visible.
 * 
 * @author jamest
 *
 */
class Zrt_Data_Filter_DeesOnly
        implements Zrt_Data_Filter_Interface
    {


    /**
     * Returns only fields that start with the letter D.
     * 
     * @param Zrt_Data_Interface $object
     * @param array $fields
     * @return array
     */
    public static function filterReadable( Zrt_Data_Interface $object , $fields )
        {
        $return = array( );
        foreach ( $fields as $field )
            {
            if ( 'd' == strtolower( substr( $field , 0 , 1 ) ) )
                {
                $return[] = $field;
                }
            }
        return $return;


        }


    /**
     * Returns only fields that start with the letter D.
     * 
     * @param Zrt_Data_Interface $object
     * @param array $fields
     * @return array
     */
    public static function filterWriteable( Zrt_Data_Interface $object , $fields )
        {
        return self::filterReadable( $object , $fields );


        }


    }