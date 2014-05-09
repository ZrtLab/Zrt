<?php


/**
 * Describes an interface for filtering
 */
interface Zrt_Data_Filter_Interface
    {


    /**
     * Determines which fields are readable for the supplied object, based on
     * current security model.
     * 
     * @param Zrt_Data_Interface $object
     * @param array $fields
     * @return array
     */
    public static function filterReadable( Zrt_Data_Interface $object ,
                                           $fields );


    /**
     * Determines which fields are writeable for the supplied object, based on
     * current security model.
     * 
     * @param Zrt_Data_Interface $object
     * @param array $fields
     * @return array
     */
    public static function filterWriteable( Zrt_Data_Interface $object ,
                                            $fields );

    }


?>