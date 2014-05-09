<?php

class Zrt_Form_SubForm_ActivarEquipos extends Zrt_SubForm {

    protected $_data;
    protected $_equipo;
    protected $id_equipo;
    protected $equipo;
    protected $calidad;
    protected $usuario;
    protected $moneda;
    protected $preciocompra;
    protected $precioventa;
    protected $paises;
    protected $imagethumb;

    public function __construct($data) {

        if (is_object($data)) {
            $this->_data = $data;
        }

        $this->id_equipo = new Zend_Form_Element_Checkbox('id_equipo');
        $this->id_equipo_hidden = new Zend_Form_Element_Hidden('id_equipo_hidden');
        $this->equipo = new Zend_Form_Element_Text('equipo');
        $this->calidad = new Zend_Form_Element_Text('calidad');
        $this->usuario = new Zend_Form_Element_Text('usuario');
        $this->moneda = new Zend_Form_Element_Text('moneda');
        $this->preciocompra = new Zend_Form_Element_Text('preciocompra');
        $this->precioventa = new Zend_Form_Element_Text('precioventa');
        $this->paises = new Zend_Form_Element_Text('paises');
        $this->imagethumb = new Zend_Form_Element_Hidden('imagethumb');


        parent::__construct();
    }

    public function init() {
        parent::init();
        
        $this->precioventa->addValidator(
                new Zend_Validate_Between(array('min' => 0.1,
                    'max' => 9999999999)
                )
        );
        $this->setDataValues();
        $this->addContentElement();
    }

    protected function addContentElement() {

        $this->addElement($this->id_equipo_hidden);
        $this->addElement($this->id_equipo);
        $this->addElement($this->equipo);
        $this->addElement($this->calidad);
        $this->addElement($this->usuario);
        $this->addElement($this->moneda);
        $this->addElement($this->preciocompra);
        $this->addElement($this->precioventa);
        $this->addElement($this->paises);
        $this->addElement($this->imagethumb);
    }

    private function setDataValues() {
        
        $this->id_equipo_hidden->setValue($this->_data->id);
        $this->id_equipo->setValue($this->_data->id);
        $this->equipo->setValue($this->_data->equipo);
        $this->preciocompra->setValue($this->_data->preciocompra);
        $this->calidad->setValue($this->_data->calidad);
        $this->usuario->setValue($this->_data->usuario);
        $this->moneda->setValue($this->_data->moneda);
        $this->precioventa->setValue($this->_data->precioventa);
        $this->paises->setValue($this->_data->paises);
        $this->imagethumb->setValue($this->_data->imageThumb);
    }

}

