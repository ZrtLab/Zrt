<?php

class Zrt_Form_EasyBib extends Zend_Form
{
    protected $model;

    /**
     * @return the $model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
    
    /**
     * Proxie to Zend_Form::isValid()
     * calls buildBootstrapErrorDecorators for parent::isValid() returning false
     *
     * @param  array $data
     * @return boolean
     */
    public function isValid($values)
    {
        $validCheck = parent::isValid($values);
        if ($validCheck === false) {
            $this->buildBootstrapErrorDecorators();
        }
        return $validCheck;
    }

    /**
     * Build Bootstrap Error Decorators
     */
    public function buildBootstrapErrorDecorators() {
        foreach ($this->getErrors() AS $key=>$errors) {
            $htmlTagDecorator = $this->getElement($key)->getDecorator('HtmlTag');
            if (empty($htmlTagDecorator)) {
                continue;
            }
            if (empty($errors)) {
                continue;
            }
            $class = $htmlTagDecorator->getOption('class');
            $htmlTagDecorator->setOption('class', $class . ' error');
        }
    }
}