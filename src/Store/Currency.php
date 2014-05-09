<?php


class Zrt_Store_Currency
    {

    protected $id;
    protected $code;
    protected $_moneda;
    protected $Zrt;
    private static $instancia;


    private function __construct()
        {
        $this->Zrt = new Zend_Session_Namespace( 'Zrt' );
        }


    public static function getInstance()
        {
        if ( !self::$instancia instanceof self )
            {
            self::$instancia = new self;
            }
        return self::$instancia;
        }


    public function setId( $value )
        {
        $this->id = $value;
        $this->Zrt->currency->id = $this->id;
        }


    public function getId()
        {
        return $this->id;
        }


    public function setCode( $value )
        {
        $this->code = $value;
        $this->Zrt->currency->code = $this->code;
        }


    public function getCode()
        {
        return $this->code;
        }


    public function getCurrency()
        {
        return $this->Zrt->currency;
        }


    }

?>
