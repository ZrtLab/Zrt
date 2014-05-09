<?php

//TODO Agregar Elemento CKEditor
class Zrt_Form_Element_Pais
        extends Zend_Form_Element_Textarea
    {

    public function init()
        {
        $this->setAttrib( 'class' , 'ckeditor' );
        }

    }
