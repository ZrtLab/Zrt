<?php


/**
 * This service class is used for image operations within the application. The 
 * main function is to generate square avatars from an abritary sized image.
 * 
 * Use the images.ini file to configure settings
 */
class Zrt_Service_Image
    {

    protected $_configuration = NULL;
    protected $_configurationFilePath = '/configs/images.ini';
    protected $_targetFilename;
    protected $_targetHeight;
    protected $_targetWidth;
    protected $_targetQuality;
    protected $_imageTargetFilepath;
    protected $_tempFilepath;


    /**
     * Initiates the process of generating an avatar
     *
     * @param String $originalFilename
     * @param String $targetFilename 
     */
    public function processImageAvata( $originalFilename , $targetFilename )
        {
        $this->_setupConfiguration( 'avatar' );
        $this->_targetFilename = $targetFilename;
        $this->_originalFilename = $originalFilename;

        $this->_resizeImage();
        }


    /**
     * Initiates the process of generating an avatar
     *
     * @param String $originalFilename
     * @param String $targetFilename 
     */
    public function processImageProduct( $originalFilename , $targetFilename )
        {
        $this->_setupConfiguration( 'product' );
        $this->_targetFilename = $targetFilename;
        $this->_originalFilename = $originalFilename;
        $this->_resizeImage();
        }


    /**
     * Initiates the process of generating an avatar
     *
     * @param String $originalFilename
     * @param String $targetFilename 
     */
    public function processImageEquipo( $originalFilename , $targetFilename )
        {
        $this->_setupConfiguration( 'equipo' );
        $this->_targetFilename = $targetFilename;
        $this->_originalFilename = $originalFilename;

        $this->_resizeImage();
        }


    /**
     * Initiates the process of generating an avatar
     *
     * @param String $originalFilename
     * @param String $targetFilename 
     */
    public function processImageThumb( $originalFilename , $targetFilename )
        {
        $this->_setupConfiguration( 'thumb' );
        $this->_targetFilename = $targetFilename;
        $this->_originalFilename = $originalFilename;

        $this->_resizeImage();
        }


    /**
     * Setup the target size and quality of the final image.
     *
     * @param String $type : The type of image been processed (e.g. avatar or logo). The settings should be 
     * 						 available in images.ini
     */
    protected function _setupConfiguration( $type )
        {
        $this->_configuration = new Zend_Config_Ini(
                        APPLICATION_PATH . $this->_configurationFilePath ,
                        APPLICATION_ENV
        );
        $this->_targetHeight = $this->_configuration->$type->height;
        $this->_targetWidth = $this->_configuration->$type->width;
        $this->_targetQuality = $this->_configuration->$type->quality;
        $this->_imageTargetFilepath = APPLICATION_PUBLIC . $this->_configuration->$type->path;
        $this->_tempFilepath = $this->_configuration->path->uploadTemp;
        }


    /**
     * Resizes the image
     */
    protected function _resizeImage()
        {
        if ( !isset( $this->_configuration ) )
            {
            throw new Zend_Exception( 'image configuration has not been setup' );
            }

        $image = imagecreatefromjpeg(
                $this->_originalFilename
        );
        $imageWidth = imagesx( $image );
        $imageHeight = imagesy( $image );

        if ( $imageHeight > $imageWidth )
            {
            $cropHeight = $imageWidth;
            $cropWidth = $imageWidth;
            $cropX = 0;
            $cropY = ($imageHeight - $cropHeight) / 2;
            ;
            }

        if ( $imageHeight < $imageWidth )
            {
            $cropHeight = $imageHeight;
            $cropWidth = $imageHeight;
            $cropX = ($imageWidth - $cropWidth) / 2;
            $cropY = 0;
            }

        if ( $imageHeight == $imageWidth )
            {
            $cropHeight = $imageHeight;
            $cropWidth = $imageWidth;
            $cropX = 0;
            $cropY = 0;
            }

        $imagePlaceHolder = imagecreatetruecolor( $this->_targetWidth ,
                                                  $this->_targetHeight );
        imagecopyresampled( $imagePlaceHolder , $image , 0 , 0 ,
                            ( int ) $cropX , ( int ) $cropY ,
                            $this->_targetWidth , $this->_targetHeight ,
                            $cropWidth , $cropHeight );
        imagejpeg( $imagePlaceHolder ,
                   $this->_imageTargetFilepath . $this->_targetFilename ,
                   $this->_targetQuality );
        }


    /**
     *
     * @param String $filename 
     */
    public function deleteImage( $filename )
        {
        //@TODO unlink files to be deleted here
        }


    }