<?php

/**
 * Slug filter
 *
 * Filter used to generate slug
 *
 * @copyright  2010 SANIsoft Technologies Pvt. Ltd.
 * @link	   http://www.sanisoft.com/
 */

/**
 * Slug filter
 *
 * Filter used to generate slug
 *
 * @copyright  2010 SANIsoft Technologies Pvt. Ltd.
 * @version	Release: 1.0
 * @link	   http://www.sanisoft.com/
 */
class My_Filter_Slug implements Zend_Filter_Interface {

    var $field;
    var $model;

    /**
     * Class constructor
     *
     * @param array $parameters Parameters used to define field name and model object
     */
    public function __construct(array $parameters) {
        // If field name and model object are provided then store them in class variables
        if (isset($parameters['field']) && isset($parameters['model'])) {
            $this->field = $parameters['field'];
            $this->model = $parameters['model'];
        }
    }

    /**
     * Method used to generate slug
     *
     * @param string $value String to generate its slug
     *
     * @return string Generated slug
     */
    public function filter($value, $conditions = null) {
        // Lowercase the string
        $value = strtolower($value);
        // Generate slug by removing unwanted (other than alphanumeric and dash [-]) characters from the string
        $value = preg_replace('/[^a-z0-9-]/i', '-', $value);
        $value = preg_replace('/-[-]*/', '-', $value);
        $value = preg_replace('/-$/', '', $value);
        $value = preg_replace('/^-/', '', $value);
        // If field name and model object are provided then check for slug duplication
        if ($this->field && $this->model) {
            // Initialize variable used to store matching slugs for currently generated slug
            $slugs = array();
            // Need to append ' AND ' to existing conditions
            if ($conditions) {
                $conditions .= ' AND ';
            }
            // Build conditions for slug duplication
            $conditions .= $this->field . ' LIKE "' . $value . '%"';
            // Get matching slugs for currently generated slug
            $select = $this->model->select();
            $select->from($this->model, array($this->field))
                    ->where($conditions);
            // Store matching slugs for currently generated slug
            foreach ($this->model->fetchAll($select) as $record) {
                $slugs[] = $record->{$this->field};
            }
            // If matching slugs for currently generated slug then try to append -1, -2, ... to currently generated slug to avoid duplication
            if (0 < count($slugs) && in_array($value, $slugs)) {
                // Lets start duplication checking with index as 1
                $index = 1;
                // Check for slug duplication
                while (true) {
                    // If currently generated slug is not duplicate then use it
                    if (!in_array($value . '-' . $index, $slugs)) {
                        $value .= '-' . $index;
                        break;
                    }
                    // Increment counter by 1
                    $index++;
                }
            }
        }
        // Return generated slug
        return $value;
    }

}