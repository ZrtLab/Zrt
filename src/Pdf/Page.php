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
 * Excudo PDF Page
 *
 * Extension of Zend Pdf Page. 
 * Has 1 extra method which can create text-blocks
 *
 * @package    Zend_Pdf
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zrt_Pdf_Page
        extends Zend_Pdf_Page
    {


    public function drawTextBlock( $text
    , $x
    , $y
    , $charEncoding = '' , $wordSpaceAdjust=False )
        {
        if ( $this->_font === null )
            {
            throw new Zend_Pdf_Exception( 'Font has not been set' );
            }

        $this->_addProcSet( 'Text' );

        $textObj = new Zend_Pdf_Element_String( $this->_font->encodeString( $text ,
                                                                            $charEncoding ) );
        $xObj = new Zend_Pdf_Element_Numeric( $x );
        $yObj = new Zend_Pdf_Element_Numeric( $y );

        $this->_contents .= "BT";
        if ( False !== $wordSpaceAdjust )
            {
            $this->_contents .= sprintf( " %.3f Tw" , $wordSpaceAdjust );
            }
        $this->_contents .= "\n"
                . $xObj->toString() . ' ' . $yObj->toString() . " Td\n"
                . $textObj->toString() . " Tj\n"
                . "ET\n";
        }


    }

?>