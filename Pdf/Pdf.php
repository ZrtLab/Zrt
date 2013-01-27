<?php

/**
 * 
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with the Zend Framework source files
 * It is available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so they can send you a copy immediately.
 *
 * @package    Zend_Pdf
 * @author     Martijn Korse - http://devshed.excudo.net
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */


/**
 * Zrt PDF
 *
 * Extension of Zend PDF. 
 * The only difference is that the method newPage creates and instance of Excudo_Pdf_Page instead of Zend_Pdf_Page.
 *
 * @package    Zend_Pdf
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zrt_Pdf_Pdf
        extends Zend_Pdf
    {


    public function newPage( $param1 , $param2 = null )
        {
        if ( $param2 === null )
            {
            return new Zrt_Pdf_Page(
                            $param1
                            , $this->_objFactory );
            }
        else
            {
            return new Zrt_Pdf_Page( $param1
                            , $param2
                            , $this->_objFactory );
            }
        }


    }

?>