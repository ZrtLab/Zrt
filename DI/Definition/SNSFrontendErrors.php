<?php
/**
 * SNS Frontend Errors object definition
 *
 * @category Zrt
 * @package Zrt_DI
 * @copyright company
 */
class Zrt_DI_Definition_SNSFrontendErrors
{
    /**
     * This method will instantiate the object, configure it and return it
     *
     * @return Zend_Cache_Manager
     */
    public static function getInstance(){
        $config = Zrt_DI_Container::get('ConfigObject');
        
        $snsConfig = array(
            'accessKey' => $config->amazon->aws_access_key,
            'privateKey' => $config->amazon->aws_private_key,
            'host' => $config->amazon->sns->host,
        );
        
        $snsConfig['topicArn'] = $config->amazon->sns->topics->frontend_errors->arn;
        $sns = new Zrt_Amazon_SNS_Topic($snsConfig);
        
        return $sns;
    }
}