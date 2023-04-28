<?php
/**
 * This file implements Validator.
 *
 * @author     Admin
 * @since      2023
 */

class Validator
{
    /**
     * [$data description]
     * @var [type]
     */
    protected $data;

    /**
     * { function_description }
     *
     * @param      array  $data   The data
     *
     * @return     self   ( description_of_the_return_value )
     */
    public function rules($data = [])
    {
        $this->data = $data;

        return $this;
    }

    /**
     * { function_description }
     *
     * @param      <type>  $condition  The condition
     * @param      string  $name       The name
     *
     * @return     bool    ( description_of_the_return_value )
     */
    public function check($condition = null, $name = null)
    {
        switch ($condition) {
            case 'required':
                return (!empty($this->data[$name])) ? true : $name . ' field is required.';
                break;

            default:
                return true;
                break;
        }
    }

}
