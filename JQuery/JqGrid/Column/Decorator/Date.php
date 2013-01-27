<?php

/**
 * @see Zrt_JQuery_JqGrid_Column_Decorator_Abstract
 */


/**
 * Decorate a column which contains a date
 * 
 * @package Zrt_JQuery_JqGrid
 * @copyright Copyright (c) 2005-2009 Warrant Group Ltd. (http://www.warrant-group.com)
 * @author Andy Roberts
 */

class Zrt_JQuery_JqGrid_Column_Decorator_Date extends Zrt_JQuery_JqGrid_Column_Decorator_Abstract
{
    protected $_options = array();

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct($column, $options = array())
    {
        $this->_column = $column;
        $this->_options = $options;
        
        $this->decorate();
    }

    /**
	 * Decorate column to display URL links
	 * 
	 * @return void
	 */
    public function decorate()
    {
        
        if (count($this->_options) == 0) {
            $this->_options['srcformat'] = 'Y-m-d H:i:s';
            $this->_options['newformat'] = 'l, F d, Y';
        }
        
        $this->_column->setOption('formatter', 'date');
        $this->_column->setOption('formatoptions', $options);
    }
}