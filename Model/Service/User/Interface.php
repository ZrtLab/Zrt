<?php

interface Zrt_Model_Service_User_Interface
    {


    /**
     * Get all users matching the specified identity.
     *
     * @param string $identity
     * @param string $credential
     * @return Zrt_Model_Set
     */
    public static function findByIdentityAndCredential( $identity , $credential );


    public static function getCredentialField();


    public static function getIdentityField();

    }