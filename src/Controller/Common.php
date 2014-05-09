<?php

/**
 * Zrt PHP Library
 *
 * @category Zrt
 * @copyright Copyright (c) 2008-2010 Jamie Talbot (http://jamietalbot.com)
 * @version $Id: Common.php 72M 2010-09-20 04:15:06Z (local) $
 */
/**
 * @defgroup Zrt_Controller Zrt Controllers
 * @defgroup Zrt_View_Helpers Zrt View Helpers
 */


/**
 * Default application controller providing standard CRUD functionality based on convention.
 *
 * @class Zrt_Controller_Common
 * @ingroup Zrt_Controller
 */
abstract class Zrt_Controller_Common
        extends Zend_Rest_Controller
        implements Zend_Acl_Resource_Interface
    {

    /**
     * Specifies which contexts are available for which controller actions.
     *
     * @var array $_contexts
     */
    protected $_contexts = array(
        'new' => 'json' ,
        'put' => 'json' ,
        'post' => 'json' ,
        'delete' => 'json' ,
        'get' => 'json' ,
        'lookup' => 'json'
    );

    /**
     * The identifier that represents the primary service for this model.
     *
     * @var string $_identifier
     */
    protected $_identifier = 'id';

    /**
     * The resource Id of this controller.
     *
     * @var string $_resourceId
     */
    protected $_resourceId = null;

    /**
     * The primary service used by this controller.
     *
     * @var Zrt_Model_Service $_service
     */
    protected $_service = null;


    /**
     * Gets the resource id of this controller.
     *
     * @return string
     */
    public function getResourceId()
        {
        return $this->_resourceId;


        }


    /**
     * Gets the primary service for this controller.
     *
     * @return Zrt_Model_Service
     */
    public function getService()
        {
        return $this->_service;


        }


    /**
     * Performs controller initialisation.
     *
     * Adds the title of the service to the page title and sets up context switching.
     */
    public function init()
        {
        if ( $this->_service )
            {
            $service = $this->_service;
            $title = $service::getTitle();
            $this->view->headTitle()->append( $title );
            }

        // Enable context switching.
        $this->_helper->contextSwitch()->addActionContexts( $this->_contexts )->initContext();

        return parent::init();


        }


    public function indexAction()
        {
        
        }


    public function deleteAction()
        {
        
        }


    /**
     * Performs the action that retrieves a single record.
     */
    public function getAction()
        {
        $record = $this->_getRecord( $this->getRequest()->getParam( $this->_identifier ) );
        return $this->_helper->processor()->record( $record );


        }


    /**
     * Generates a structure for supplying a new record.
     *
     * Uses the data processor to generate an appropriate structure.  Typically, this is an HTML form
     * or a JSON record template of the entity.
     */
    public function newAction()
        {
        $record = $this->_attachParent( $this->_getRecord( null ) );

        return $this->_helper->processor()->template( $record );


        }


    /**
     * Returns a structure for editing an existing record.

     * Uses the data processor to generate an appropriate structure.  Typically, this is an HTML form
     * or a JSON record template of the existing entity.
     */
    public function editAction()
        {
        $record = $this->_getRecord( $this->getRequest()->getParam( $this->_identifier ) );
        return $this->_helper->processor()->template( $record );


        }


    /**
     * Handles the saving of new records.
     */
    public function putAction()
        {
        $this->_save();


        }


    /**
     * Handles updating of records.
     */
    public function postAction()
        {
        $this->_save();


        }


    /**
     * Returns data in a format suitable for looking up for selects.
     */
    public function lookupAction()
        {
        $this->_helper->processor()->lookup();


        }


    /**
     * Attaches a parent to the record, if one is specified.  Also
     * appends parent record details to the page title.
     *
     * @param Zrt_Model $record
     *
     * @return Zrt_Model
     */
    protected function _attachParent( Zrt_Model $record = null )
        {
        $service = $this->_service;
        $parentReferences = $service::getParentReferencedFields();
        $parent = $this->getRequest()->getParam( 'parent' , array( ) );
        if ( $parent )
            {
            $parentService = $parentReferences[$parent['field']];
            $parentTitle = $parentService::getTitle();
            $parentDescription = $parentService::getDescription( $parent['id'] );
            if ( $record )
                {
                $record->{$parent['field']} = $parent['id'];
                }
            $this->view->headTitle()->prepend( $parentDescription );
            $this->view->headTitle()->prepend( $parentTitle );
            }
        return $record;


        }


    /**
     * Saves a record, based on the supplied data.
     *
     * Uses the data processor to retrieve supplied data, populates
     * a record and saves it.  Proxies to data processor for the correct
     * behaviour on success, error or invalid data.
     */
    protected function _save()
        {
        $service = $this->_service;
        $id = $this->getRequest()->getParam( $this->_identifier );
        $record = $this->_getRecord( $id );
        $record->setFromArray( array_intersect_key( $this->_helper->processor()->getData() ,
                                                    $service::getFields() ) );

        $record = $this->_attachParent( $record );

        if ( $record->isValid() )
            {
            try
                {
                $record->save();
                $responseCode = $id ? Zrt_Http::OK : Zrt_Http::CREATED;
                $this->getResponse()->setHttpResponseCode( $responseCode );
                $this->_helper->processor()->success( $record );
                }
            catch ( Exception $e )
                {
                $this->getResponse()->setHttpResponseCode( Zrt_Http::INTERNAL_SERVER_ERROR );
                $this->_helper->processor()->error( $record );
                }
            }
        else
            {
            $this->getResponse()->setHttpResponseCode( Zrt_Http::PRECONDITION_FAILED );
            $this->_helper->processor()->invalid( $record );
            }


        }


    /**
     * Gets the record for processing, and handles the case where an invalid identifier is specified.
     *
     * @param int $id
     * @return Zrt_Model
     */
    protected function _getRecord( $id = null )
        {
        $service = $this->_service;
        return $service::fetchOrCreateRecord( $id );


        }


    /**
     * Catch all for missing functions.
     *
     * @throws Zrt_Exception When the function is not a controller action.
     */
    public function __call( $method , $arguments )
        {
        if ( 'Action' == substr( $method , -6 ) )
            {
            // We tried to perform an action that wasn't available, so redirect to the index instead.
            $controller = $this->getRequest()->getControllerName();
            $id = $this->getRequest()->getParam( $this->_identifier );
            Zrt_Feedback::add( Zrt_Feedback::ERROR ,
                               "The URL you tried was not valid." );
            if ( $id )
                {
                return $this->_redirect( "/$controller/$id/" );
                }
            else
                {
                return $this->_redirect( "/$controller/" );
                }
            }
        // This was a genuine error, so just throw the exception.
        throw new Zrt_Exception( "Invalid method call: $method" );


        }


    }