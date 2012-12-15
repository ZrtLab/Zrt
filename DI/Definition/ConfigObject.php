<?php

/**
 * Config object definition
 *
 * @category Zrt
 * @package Zrt_DI
 * @copyright company
 */
class Zrt_DI_Definition_ConfigObject
{

    /**
     * This method will instantiate the object, configure it and return it
     *
     * @return Zend_Config_Ini
     */
    public static function getInstance()
    {
        $applicationini = new Zend_Config_Ini(APPLICATION_PATH . "/configs/application.ini", APPLICATION_ENV);

        $options = $applicationini->toArray();
        foreach (Index::getIni() as $value) {
            $iniFile = APPLICATION_PATH . Index::getPath() . $value;
            if (is_readable($iniFile)) {
                $config = new Zend_Config_Ini($iniFile);
                $options = array_merge($options, $config->toArray());
            }
        }

        return new Zend_Config($options);
    }

}