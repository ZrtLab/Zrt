<?php


class Zrt_Form_SubForm_Checkout
        extends Zrt_SubFormy
    {

    protected $_currency;
    protected $_data;
    protected $_equipo;
    protected $_formapago;
    protected $id_equipo;
    protected $id_equipo_check;
    protected $image;
    protected $equipo;
    protected $equipo_id;
    protected $formaPago;
    protected $precio;
    protected $eliminar;


    public function setData( $value )
        {
        $this->_data = $value;
        }


    private function _setValue()
        {
        
        }


    private function _addContentElement()
        {
        
        }


    public function __construct( $options = null )
        {
        $this->_formapago = new Zrt_Models_Bussines_FormaPago();
        $this->image = new Zend_Form_Element_Image( 'image' );
        $this->equipo = new Zend_Form_Element_Text( 'equipo' );
        $this->precio = new Zend_Form_Element_Text( 'precio' );
        $this->formaPago = new Zend_Form_Element_Select( 'equipo_has_formapago_id' );
        $this->id_equipo = new Zend_Form_Element_Hidden( 'equipo_id' );
        $this->id_equipo_check = new Zend_Form_Element_Checkbox( 'id_equipo_check' );
        parent::__construct( $options );
        }


    public function init()
        {
        parent::init();
        $this->setMethod( Zend_Form::METHOD_POST )
                ->setAction( '/user/checkout/delete/' );
        if ( is_object( $this->_data ) )
            {
            
            $this->_currency = new Zend_Currency(
                            $this->_data->getCodeMoneda()
            );

            $this->setElementsBelongTo( "carro[{$this->_data->getId()}]" );

            $this->id_equipo_check->setValue( $this->_data->getId() );

            $this->id_equipo_check->setAttrib( 'width' , '10px' );
            $this->addElement( $this->id_equipo_check );


            $this->id_equipo->setValue( $this->_data->getId() );

            $this->addElement( $this->id_equipo );

            $this->image->setImage(
                    "/media/catalog/product/no_image.png"
            )
            ;

            $this->addElement( $this->image );

            $this->equipo->setValue( $this->_data->getNombre() )
                    ->setAttrib( 'readonly' , "readonly" )
            ;
            $this->addElement( $this->equipo );

            $this->precio->setValue(
                            $this->_currency->toCurrency(
                                    $this->_data->getPrecio()
                            )
                    )
                    ->setAttrib( 'readonly' , "readonly" );
            $this->addElement( $this->precio );

            $dataFormaPago = $this->_formapago->getComboValues();
            $this->formaPago->addMultiOption( -1 ,
                                              $this->_translate->translate(
                            'escoger forma de pago'
                    )
            );
            $this->formaPago->addMultiOptions(
                            $dataFormaPago
                    )
                    ->setValue(
                            $this->_data->getEquipo_has_formaPago()
            );
            $this->addElement(
                    $this->formaPago
            )
            ;

            $this->formaPago->addValidator(
                    new Zend_Validate_InArray(
                            array_keys(
                                    $dataFormaPago
                            )
                    )
            );
            }
        }


    public function setRowNumber( $num )
        {
        $this->rowNumber = ( int ) $num;
        return $this;
        }


    }

