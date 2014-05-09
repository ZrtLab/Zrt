<?php


class Zrt_Db_Document_Adapter_Facebook
    {

    /**
     * @var Zend_Http_Client HTTP client used for accessing server
     */
    protected $_client;
    protected $_config = array(
        'host' => 'graph.facebook.com' ,
        'ssl' => true ,
    );
    // The base URI for this connection.
    protected $_baseUri = null;
    // Whether the connection information has changed.
    protected $_dirty = true;


    public function __construct( $config = array( ) )
        {
        if ( null !== $config )
            {
            if ( is_array( $config ) )
                {
                $this->setFromArray( $config );
                }
            elseif ( $config instanceof Zend_Config )
                {
                $this->setFromConfig( $config );
                }
            elseif ( is_string( $config ) )
                {
                $this->setDb( $config );
                }
            }


        }


    public function setFromArray( array $options )
        {
        foreach ( $options as $key => $value )
            {
            $method = 'set' . ucfirst( $key );
            if ( method_exists( $this , $method ) )
                {
                $this->$method( $value );
                }
            }
        return $this;


        }


    public function setFromConfig( Zend_Config $config )
        {
        return $this->setFromArray( $config->toArray() );


        }


    /**
     * Retrieves documents from facebook based on IDs, or null if nothing is found.
     *
     * @param string|array $id
     * @throws Zrt_Exception
     * @return Zrt_Db_Document_FacebookSet
     */
    public function find( $identifiers )
        {
        if ( !is_array( $identifiers ) )
            {
            $identifiers = array( $identifiers );
            }

        foreach ( $identifiers as $identifier )
            {
            $response = $this->_prepare( "/$identifier/" )->_execute( Zend_Http_Client::GET );

            $status = $response->getStatus();
            $return = array( );
            switch ( $status )
                {
                case Zrt_Http::OK:
                    $return[] = new Zrt_Db_Document_Facebook( array(
                                'adapter' => $this ,
                                'data' => $response->getBody()
                            ) );
                    break;

                case Zrt_Http::NOT_FOUND:
                    break;

                case Zrt_Http::UNAUTHORISED:
                    throw new Zrt_Exception( "Database username and password were incorrect" );
                    break;

                case Zrt_Http::BAD_REQUEST:
                    throw new Zrt_Exception( "Error in call: " . $response->getBody() );
                    break;

                case Zrt_Http::UNSUPPORTED_MEDIA_TYPE:
                    throw new Zrt_Exception( "Content type must be application/json" );
                    break;

                default:
                    throw new Zrt_Exception( "Response code $status not handled." );
                    break;
                }
            }
        return new Zrt_Db_Document_FacebookSet( array(
                    'adapter' => $this ,
                    'data' => $return
                ) );


        }


    /**
     * Saves a document, either by creating or updating it.
     *
     * @param Zrt_Db_Document_Couch $document
     * @param string $method
     * @throws Zrt_Exception
     */
    public function save( Zrt_Db_Document_Couch $document ,
                          $method = Zend_Http_Client::PUT )
        {
        throw new Exception( "Not supported yet." );


        }


    protected function _getBaseUri()
        {
        if ( !$this->_dirty )
            {
            return $this->_baseUri;
            }

        // Save the constructed base URI and mark it clean so we don't regenerate next time.
        $this->_baseUri = "https://" . $this->getHost();
        $this->_dirty = false;

        return $this->_baseUri;


        }


    public function getHost()
        {
        return $this->_config['host'];


        }


    public function ping()
        {
        return $this->_prepare( '/' )->_execute()->getBody();


        }


    public function _prepare( $path , $parameters = null )
        {
        $client = $this->getHttpClient();
        $base = $this->_getBaseUri();
        $path = ltrim( $path , '/' );
        $client->setUri( "$base/$path" );
        if ( null !== $parameters )
            {
            foreach ( $parameters as $key => $value )
                {
                $parameters[$key] = Zend_Json::encode( $value );
                }
            $client->setParameterGet( $parameters );
            }
        return $this;


        }


    protected function _execute( $method = Zend_Http_Client::GET )
        {
        $client = $this->getHttpClient();
        $response = $client->request( $method );
        $client->resetParameters();
        return $response;


        }


    /**
     * Get current HTTP client
     *
     * @return Zend_Http_Client
     */
    public function getHttpClient()
        {
        if ( null === $this->_client )
            {
            $this->_client = new Zend_Http_Client();
            }
        return $this->_client;


        }


    }
