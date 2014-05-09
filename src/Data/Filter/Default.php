<?php


/**
 * Default filter, performs no filtering.
 *
 * @author jamest
 *
 */
class Zrt_Data_Filter_Default
        implements Zrt_Data_Filter_Interface
    {


    /**
     * Returns all the supplied fields, as they are all readable with no filtering.
     *
     * @param Zrt_Data_Interface $object
     * @param array $fields
     * @return array
     */
    public static function filterReadable( Zrt_Data_Interface $object , $fields )
        {
        return $fields;


        }


    /**
     * Returns all the supplied fields, as they are all writeable with no filtering.
     *
     * @param Zrt_Data_Interface $object
     * @param array $fields
     * @return array
     */
    public static function filterWriteable( Zrt_Data_Interface $object , $fields )
        {
        return $fields;


        }


    }