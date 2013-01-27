<?php

/**
 * Zrt PHP Library
 *
 * @category Zrt
 * @package Zrt_Auth
 * @copyright Copyright (c) 2008-2010 Jamie Talbot (http://jamietalbot.com)
 * @version $Id: RpxNow.php 69 2010-09-08 12:32:03Z jamie $
 */


/**
 * Allows authentication using Facebook.
 *
 * @category Zrt
 * @package Zrt_Auth
 */
class Zrt_Auth_Adapter_Facebook
        implements Zrt_Auth_Adapter_Interface
    {

    const EXCEPTION_BAD_SIGNATURE = 'EXCEPTION_BAD_SIGNATURE';

    const EXCEPTION_UNKNOWN_ALGORITHM = 'EXCEPTION_UNKNOWN_ALGORITHM';

    const EXCEPTION_FACEBOOK_ERROR = 'EXCEPTION_FACEBOOK_ERROR';

    /**
     * The adapter to use to authenticate locally, once Facebook has authenticated successfully.
     *
     * @var Zrt_Auth_Adapter_Interface $_localAuthAdapter
     */
    protected $_localAuthAdapter = null;
    protected $_applicationSecret = null;
    protected $_applicationId = null;
    protected $_signedRequest = null;
    protected $_result = null;


    public function __construct( $applicationId , $applicationSecret ,
                                 $localAuthAdapter , $url = null )
        {
        $this->setApplicationId( $applicationId )
                ->setApplicationSecret( $applicationSecret )
                ->setLocalAuthAdapter( $localAuthAdapter );

        if ( null !== $url )
            {
            $this->setUrl( $url );
            }


        }


    public function setLocalAuthAdapter( $localAuthAdapter )
        {
        $this->_localAuthAdapter = $localAuthAdapter;


        }


    /**
     * Gets the adapter used to authenticate locally.
     *
     * @return Zrt_Auth_Adapter_Interface
     */
    public function getLocalAuthAdapter()
        {
        return $this->_localAuthAdapter;


        }


    public function setApplicationId( $applicationId )
        {
        $this->_applicationId = $applicationId;
        return $this;


        }


    public function setApplicationSecret( $applicationSecret )
        {
        $this->_applicationSecret = $applicationSecret;
        return $this;


        }


    public function setSignedRequest( $signedRequest )
        {
        $this->_signedRequest = $signedRequest;
        return $this;


        }


    public function setUrl( $url )
        {
        $this->_url = $url;
        return $this;


        }


    protected function _base64UrlDecode( $input )
        {
        return base64_decode( strtr( $input , '-_' , '+/' ) );


        }


    /**
     * Authenticates via cURL.
     *
     * @return Zend_Auth_Result
     */
    public function authenticate()
        {

        if ( !$this->_applicationId || !$this->_applicationSecret || !$this->_signedRequest )
            {
            throw new Zend_Auth_Adapter_Exception( "Missing information for Facebook authentication." );
            }

        list($encodedSignature , $payload) = explode( '.' ,
                                                      $this->_signedRequest , 2 );
        $signature = $this->_base64UrlDecode( $encodedSignature );
        $data = json_decode( $this->_base64UrlDecode( $payload ) , true );

        // Check for correct signing algorithm.
        if ( strtoupper( $data['algorithm'] ) !== 'HMAC-SHA256' )
            {
            $this->getRequest()->setParam( 'error_handler' ,
                                           Zrt_Auth_Adapter_Facebook::EXCEPTION_UNKNOWN_ALGORITHM );
            $this->_forward( 'error' , 'error' );
            }

        // Check for correct signature
        $expectedSignature = hash_hmac( 'sha256' , $payload ,
                                        $this->_applicationSecret , $raw = true );
        if ( $signature !== $expectedSignature )
            {
            $this->getRequest()->setParam( 'error_handler' ,
                                           Zrt_Auth_Adapter_Facebook::EXCEPTION_BAD_SIGNATURE );
            $this->_forward( 'error' , 'error' );
            }

        $result = $data['registration'];
        $result['userId'] = $data['user_id'];
        $this->_result = $result;

        return new Zend_Auth_Result( Zend_Auth_Result::SUCCESS , $data['user_id'] , array( 'Authentication Successful' ) );


        }


    /**
     * Gets the result of the authentication attempt.
     */
    public function getResult()
        {
        return $this->_result;


        }


    }


?>