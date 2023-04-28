<?php
/**
 * This file implements Request.
 *
 * @author     Admin
 * @since      2023
 */

class Request
{   
    /**
     * [$data description]
     * @var [type]
     */
    protected $data;

    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function inputs()
    {
        return $this->data;
    }

    /**
     * Gets the specified inputs.
     *
     * @param      array  $inputs  The inputs
     *
     * @return     self   ( description_of_the_return_value )
     */
    public function get($inputs = [])
    {
        if (!empty($inputs)) {
            foreach ($inputs as $key => $input) {
                if ($filter = self::filter($input)) {
                    $this->data[$input] = $filter;
                }
            }
        }
        return $this;
    }

    /**
     * { function_description }
     *
     * @param      <type>  $input  The input
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    private function filter($input = null)
    {
        $method = $this->method($input);

        return (!empty($input))
        ? htmlspecialchars(stripslashes(trim($method)))
        : null;

    }

    /**
     * { function_description }
     *
     * @param      <type>  $input  The input
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    private function method($input = null)
    {
        return ($_SERVER["REQUEST_METHOD"] == "POST")
        ? $_POST[$input]
        : $_GET[$input];
    }
}
