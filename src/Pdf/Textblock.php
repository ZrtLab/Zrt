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
 * PDF Textblock
 *
 * A class that can handle big strings and output them like a textblock consisting of multiple lines with custom alignment
 *
 * @package    Zend_Pdf
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zrt_Pdf_Textblock
    {

    /**
     * Some constants of possible alignment values
     */
    const ALIGN_LEFT = 'left';
    const ALIGN_RIGHT = 'right';
    const ALIGN_CENTER = 'center';
    const ALIGN_JUSTIFY = 'justify';

    /**
     * @var Zend_Pdf_Resource_Font
     */
    protected $_font;

    /**
     * The fontsize we have to work with in this textblock
     *
     * @var Float
     */
    protected $_fontsize;

    /**
     * The total width of the string that we have to convert into multiple lines (if necessary)
     * 
     * @var Float
     */
    protected $_totalWidth = 0;

    /**
     * The (maximum) width we want 1 line to have
     * 
     * @var Float
     */
    protected $_lineWidth = 0;

    /**
     * The total height of all the lines of this textblock together
     * This is the sum of the height of all the lines + the gap between them
     * 
     * @var Float
     */
    protected $_totalHeight = 0;

    /**
     * The height of 1 line
     * This is calculated based on the font passed to the constructor
     * 
     * @var Float
     */
    protected $_lineHeight = 0;

    /**
     * The height of the gap between the individual lines
     * This is calculated based on the font passed to the constructor
     * 
     * @var Float
     */
    protected $_lineGap = 0;

    /**
     * The width we want this block to have
     * 
     * @var Float
     */
    protected $_blockWidth = 0;

    /**
     * Alignment of this textblock
     *
     * setting default to Left
     */
    protected $_align = self::ALIGN_LEFT;

    /**
     * Array that will hold all the individual lines
     */
    protected $_lines = array( );

    /**
     * Array that will hold all the widths of the lines in $this->_lines,
     * using the same indexes
     */
    protected $_lineWidths = array( );


    /**
     * 
     * Constructor
     *
     * @param Zend_Pdf_Resource_Font $font
     * @param Float $fontSize
     */
    public function __construct( Zend_Pdf_Resource_Font $font , $fontsize ,
                                 $blockWidth = 0 )
        {
        $this->_font = $font;
        $this->_fontsize = $fontsize;
        $this->_lineHeight = ($font->getLineHeight() / $font->getUnitsPerEm()) * $fontsize;
        $this->_lineGap = ($font->getLineGap() / $font->getUnitsPerEm()) * $fontsize;
        // if a width is passed, we set it
        if ( $blockWidth > 0 )
            {
            $this->setBlockWidth( $blockWidth );
            }
        }


    /**
     * Parses a string and returns the total width
     *
     * If font and fontsize are not set, the ones passed to the constructor are used
     *
     * Credits for this calculation go to Willie Alberty:
     * http://framework.zend.com/issues/browse/ZF-313
     *
     * @param String $string
     * @param Zend_Pdf_Resource_Font $font (optional)
     * @param Float $fontSize (optional)
     *
     * @return Float;
     */
    function parseString( $string , $font=null , $fontsize=null )
        {
        if ( is_null( $font ) ) $font = $this->_font;
        if ( is_null( $fontsize ) ) $fontsize = $this->_fontsize;

        $drawingString = iconv( '' , 'UTF-16BE' , $string );
        $characters = array( );
        for ( $i = 0; $i < strlen( $drawingString ); $i++ )
            {
            $characters[] = (ord( $drawingString[$i++] ) << 8) | ord( $drawingString[$i] );
            }
        $glyphs = $font->glyphNumbersForCharacters( $characters );
        $widths = $font->widthsForGlyphs( $glyphs );
        $stringWidth = (array_sum( $widths ) / $font->getUnitsPerEm()) * $fontsize;
        return $stringWidth;
        }


    /**
     * Creates an array of lines based on one line
     * This array can later be used to create a textblock of individual lines
     *
     * This method doesn't return anything, but saves the lines in the _lines array
     * Use the public drawText() to output the lines.
     *
     * @param String $string
     * @param Float	$maxWidth
     *
     * @return Void
     * 
     * @todo handle whitespaces better (currently any whitespace is handles as 1 space)
     * @todo handle words that are too long to fit in the textblock
     */
    function createBlock( $string , $maxWidth = null )
        {
        if ( !is_null( $maxWidth ) )
            {
            $this->setBlockWidth( $maxWidth );
            }

        $this->_lines = array( );
        // exploding on newlines so we get an array of paragraphs
        $paragraphs = preg_split( '/\r\n|\r|\n/' , $string );
        foreach ( $paragraphs AS $paragraph )
            {
            if ( !empty( $paragraph ) )
                {
                // explode on whitespaces so we get individual words
                // TODO: fix tabs, multiple spaces
                $words = preg_split( '/\s+/' , $paragraph );
                $tempLine = '';
                $lastLine = '';
                foreach ( $words AS $word )
                    {
                    $lastLine = $tempLine;
                    $tempLine .= $tempLine != '' ? ' ' . $word : $word;
                    if ( $this->parseString( $tempLine ) > $maxWidth )
                        {
                        if ( $lastLine == '' )
                            {
                            // TODO: we have to break up the word
                            }
                        else
                            {
                            $this->addLine( $lastLine , null , False );
                            $tempLine = $word;
                            }
                        }
                    }
                $this->addLine( $tempLine );
                }
            else
                {
                $this->addLine( '' );
                }
            }
        }


    /**
     * uses an Excudo_Pdf_Page object to output
     *
     * @param Zend_Pdf_Page $page
     * @param Float $x
     * @param Float $y
     *
     * @return Float the totalheight of the textblock that was outputted
     */
    public function drawText( Zrt_Pdf_Page &$page , $x , $y )
        {
        $xPos = $x;
        $yPos = $y;
        foreach ( $this->_lines AS $i => $line )
            {
            // word space adjustment
            $wsa = False;

            if ( $this->_align == self::ALIGN_RIGHT )
                {
                $xPos = $x + ($this->_blockWidth - $line['width']);
                }
            elseif ( $this->_align == self::ALIGN_CENTER )
                {
                $xPos = ( ($x + ($this->_blockWidth - $line['width'])) + $x ) / 2;
                }
            elseif ( $this->_align == self::ALIGN_JUSTIFY )
                {
                $wordCount = count( preg_split( '/\s+/' , $line['text'] ) );
                if ( $wordCount > 1 && !$line['lastInParagraph'] )
                        $wsa = ($this->_blockWidth - $line['width']) / ($wordCount - 1);
                }
            if ( $this->_align == self::ALIGN_JUSTIFY )
                    $page->drawTextBlock( $line['text'] , $xPos , $yPos , null ,
                                          $wsa );
            else $page->drawText( $line['text'] , $xPos , $yPos );
            $yPos -= ($this->_lineHeight + $this->_lineGap);
            }
        return $this->_totalHeight;
        }


    /**
     * Adds a line to the internal array of lines
     * If the width is not passed, it will be calculated
     *
     * @param String $string Line of text
     * @param Float $width the width of this line (in case you know it at the time of passing)
     * @param Boolean $lastInParagraph. When true, the width of this line is recorded
     */
    protected function addLine( $string , $width = null ,
                                $lastInParagraph = True )
        {
        if ( is_null( $width ) )
            {
            $width = $this->parseString( $string );
            }
        $this->_lines[] = array(
            'text' => $string ,
            'width' => $width ,
            'lastInParagraph' => $lastInParagraph
        );
        $this->_totalHeight += $this->_lineHeight + $this->_lineGap;
        }


    /**
     * sets (and checks) the alignment of the textblock
     *
     * @param $align has to be a constant of this class, indicating the alignment
     */
    public function setAlignment( $align )
        {
        if ( !in_array( $align ,
                        array( self::ALIGN_LEFT , self::ALIGN_RIGHT , self::ALIGN_CENTER , self::ALIGN_JUSTIFY ) ) )
            {
            throw new Exception( 'this is not a valid alignment value' );
            }
        else
            {
            $this->_align = $align;
            }
        }


    /**
     * setter for the width of the textblock
     * whatever is passed will be converted to a float without checking
     *
     * @param $width
     */
    public function setBlockWidth( $width )
        {
        $this->_blockWidth = ( float ) $width;
        }


    /**
     * getter for the blockWidth
     *
     * @return Float
     */
    public function getBlockWidth()
        {
        if ( False === 0 ) throw new Exception( 'Textblock width not set' );
        else return $this->_blockWidth;
        }


    }

?>