<?php


class Zrt_Form_Tabular_Element_Tinymce
        extends Zrt_Form_Tabular_Element_Textarea
    {


    public function init()
        {
        $view = $this->getView();
        $view->headScript()->appendFile( '/js/tiny_mce/tiny_mce.js' );
        //$view->headScript()->appendFile(  '/js/tiny_mce/jquery.tinymce.js' );
        //$view->headScript()->appendFile(  '/js/mce-setup.js'  );

        $this->addFilter( 'StringTrim' )
//                ->addPrefixPath( 'App_Filter' , 'App/Filter/' , 'filter' )
//                ->addFilter( 'TinymceBadHtml' )
//                ->addFilter( 'StripWordFormatting' )
                ->setAttrib( 'cols' , 60 )
                ->setAttrib( 'rows' , 10 )
                ->setAttrib( 'class' , 'rich-text' );
        }


    }

?>