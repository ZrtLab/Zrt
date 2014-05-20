<?php

namespace Zrt\Tests\Application\Resource;
use PHPUnit_Framework_TestCase,
    Zend_Application,
    Zend_Application_Bootstrap_Bootstrap,
    Zend_Controller_Front,
    Zrt\Application\Resource\Solarium as ResourceSolarium;

class SolariumTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->application = new Zend_Application('testing');
        $this->bootstrap = new Zend_Application_Bootstrap_Bootstrap($this->application);
        Zend_Controller_Front::getInstance()->resetInstance();
    }

    public function testInitializationReturnsParablesApplicationResourceSolarium()
    {
        $options = array();
        $resource = new ResourceSolarium($options);
        $resource->setBootstrap($this->bootstrap);
        $solarium = $resource->init();

        $this->assertType('ZRTSolarium_Registry', $solarium);
    }

    public function testInitializationInitializesSolarium()
    {
        $options = array();

        $resource = new ResourceSolarium($options);
        $resource->setBootstrap($this->bootstrap);
        $resource->init();
    }

    //public function testInitializationInitializesManagerMemcacheResultCache()
    //{
        //if (extension_loaded('memcache')) {
            //$options = array(
                //'manager' => array(
                    //'attributes' => array(
                        //'attr_result_cache' => array(
                            //'driver' => 'memcache',
                            //'options' => array(
                                //'servers' => array(
                                    //'host' => 'localhost',
                                    //'port' => 11211,
                                    //'persistent' => true,
                                //),
                                //'compression' => false,
                            //),
                        //),
                    //),
                //),
            //);

            //$resource = new ZFDoctrine_Application_Resource_Doctrine($options);
            //$resource->setBootstrap($this->bootstrap);
            //$resource->init();

            //$manager = Doctrine_Manager::getInstance();
            //$cache = $manager->getAttribute(Doctrine::ATTR_RESULT_CACHE);

            //$this->assertThat(
                //$cache,
                //$this->isInstanceOf('Doctrine_Cache_Memcache')
            //);
        //}
    //}

}
