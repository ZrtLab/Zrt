<?php


abstract class Zrt_Model_Mapper
    {

    const MAPPER_TYPE_SIMPLE = 'Simple';

    const MAPPER_TYPE_COMPLEX = 'Complex';

    const MAPPER_TYPE_DISTRIBUTED = 'Distributed';

    const MAPPER_TYPE_CUSTOM = 'Custom';

    /**
     * The service requiring access to the underlying.
     */
    protected $_service = null;

    /**
     * Whether or not to cache the next call.
     *
     * @var boolean
     */
    protected $_caching = false;

    /**
     * Whether the caching should executed against the shared cache.
     *
     * @var boolean
     */
    protected $_cacheShared = false;

    /**
     * The tags to cache the data against.  Allows for targeted cache clearing.
     *
     * @var array
     */
    protected $_cacheTags = array( );

    /**
     * Flag to wrap the next query in a single model.
     *
     * @var boolean
     */
    protected $_single = false;

    /**
     * Flag to wrap the next query in a model set.
     *
     * @var boolean
     */
    protected $_multiple = false;


    /**
     * Indicates the next function call is cacheable.
     *
     * @param array $cacheTags The tags to cache this query against.
     * @return Zrt_Model_Mapper
     */
    public function cache( array $cacheTags , $shared = false )
        {
        $this->_caching = true;
        $this->_cacheTags = $cacheTags;
        $this->_cacheShared = $shared;
        return $this;


        }


    /**
     * Indicates the next function call will give a single result.
     *
     * @return Zrt_Model_Mapper
     */
    public function single()
        {
        $this->_single = true;
        return $this;


        }


    /**
     * Indicates the next function call will give multiple results.
     *
     * @return Zrt_Model_Mapper
     */
    public function multiple()
        {
        $this->_multiple = true;
        return $this;


        }


    /**
     * Default functionality is to match business model fields to underlying fields directly,
     * but append referenced fields with _id.
     *
     * @return array
     */
    public function getFieldMap()
        {
        $service = $this->_service;
        $fieldData = $service::getFields();
        foreach ( $fieldData as $field => $definition )
            {
            $return[$field] = (in_array( $definition['type'] ,
                                         array(
                        Zrt_Model_Service::FIELD_TYPE_REFERENCE ,
                        Zrt_Model_Service::FIELD_TYPE_PARENT_REFERENCE
                    ) )) ? $field . '_id' : $field;
            }
        return $return;


        }


    /**
     * Returns the service that is using this mapper.
     *
     */
    public function getService()
        {
        return $this->_service;


        }


    /**
     * Executes the required function from the base(s).
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    abstract protected function _execute( $method , $arguments );


    /**
     * Wraps the resultant data in a homogenous model or set.
     *
     * @param mixed $data
     * @return Zrt_Model|Zrt_Model_Set
     */
    abstract protected function _wrap( $data );


    /**
     * Determines whether we got data back from the base.
     *
     * @param mixed $data
     */
    abstract protected function _result( $data );


    /**
     * Performs the requested function from the underlying, optionally caching the result and wrapping
     * it in a model or model set.
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call( $method , $arguments )
        {

        if ( $this->_caching )
            {
            $key = md5( $this->_service . $method . serialize( $arguments ) );
            $data = Zrt_Cache_Manager::cache( 'default' )->shared( $this->_cacheShared )->load( $key );
            if ( false === $data )
                {
                $data = $this->_execute( $method , $arguments );
                $data = $this->_result( $data ) ? ($this->_single || $this->_multiple)
                                    ? $this->_wrap( $data ) : $data  : null;

                // We also cache negative results here.
                Zrt_Cache_Manager::cache( 'default' )->shared( $this->_cacheShared )->save( $data ,
                                                                                               $key ,
                                                                                               $this->_cacheTags );
                }
            $this->_caching = false;
            $this->_cacheTags = array( );
            $this->_cacheShared = false;
            }
        else
            {
            // Not caching, just pass through and wrap.
            $data = $this->_execute( $method , $arguments );
            $data = $this->_result( $data ) ? ($this->_single || $this->_multiple)
                                ? $this->_wrap( $data ) : $data  : null;
            }

        // Reset wrappers.
        $this->_single = $this->_multiple = false;
        return $data;


        }


    }