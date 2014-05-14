<?php

/**
 * Provides resource versioning capabilities.
 *
 * @ingroup Zrt_Resource
 */
class Zrt_Resource
{

    const RESOURCE_LIST = 'configs/resources.ini';

    /**
     * An array of resources that are under version control for caching.
     * @var Zend_Config_Ini
     */
    protected static $_resources = null;

    public static function setupResources()
    {
        if (null === self::$_resources) {
            self::$_resources = new Zend_Config_Ini( APPLICATION_PATH . '/' . self::RESOURCE_LIST );
        }
    }

    /**
     * Returns the URL to a static file, prepended with the base URL,
     * injecting a version number so we can aggressively cache resources.
     *
     * @param  string $resource
     * @return string
     */
    public static function version($resource)
    {
        if ( Zrt_Application::isDevelopment() ) {
            $version = filemtime( $resource );
        } else {
            self::setupResources();
            list($path , $extension) = explode( '.' , $resource , 2 );
            $subSections = explode( '/' , $path );

            $versionedResource = self::$_resources;
            foreach ($subSections as $subSection) {
                if ( !isset( $versionedResource->$subSection ) ) {
                    $versionedResource = null;
                    break;
                }
                $versionedResource = $versionedResource->$subSection;
            }
            if (null == $versionedResource) {
                return Zrt_Application::tenantUrl() . '/' . $resource;
            }
            $version = $versionedResource;
        }

        return Zrt_Application::tenantUrl() . '/' . preg_replace( '/\.([a-z]+?)$/' ,
            ".v$version.\$1" ,
            $resource );

    }

}
