<?php

interface Zrt_Controller_Processor_Interface
    {


    public function __construct( Zrt_Controller_Common $actionController );


    public function getData();


    public function record( Zrt_Model $record );


    public function template( Zrt_Model $record );


    public function success( Zrt_Model $record );


    public function error( Zrt_Model $record );


    public function invalid( Zrt_Model $record );

    }