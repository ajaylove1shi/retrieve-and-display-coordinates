<?php
/**
 * This file implements Coordinate.
 *
 * @author     Admin
 * @since      2023
 */

include 'Response.php';
include 'Validator.php';
include 'Request.php';
include 'Curl.php';
include 'Constant.php';

/**
 * Coordinate Class
 */
class Coordinate extends Curl
{
	/**
	 * [$instance description]
	 * @var [type]
	 */
    private static $instance;

    /**
     * [$request description]
     * @var [type]
     */
    private $request;

    /**
     * [$validator description]
     * @var [type]
     */
    private $validator;

    /**
     * [$response description]
     * @var [type]
     */
    private $response;

    /**
     * [__construct description]
     */
    private function __construct()
    {
        $this->request = new Request();

        $this->validator = new Validator();

        $this->response = new Response();

    }

    /**
     * Gets the instance.
     *
     * @return     <type>  The instance.
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function get()
    {
        $inputs = $this->request->get(['address', 'api'])->inputs();

        $validated = [
            $this->validator->rules($inputs)->check('required', 'address'),
            $this->validator->rules($inputs)->check('required', 'api'),
        ];

        if (count(array_unique($validated)) > 1) {
            return $this->response->validator($validated);
        }

        $url = $this->uri($inputs['address']);

        $data = $this->url($url)->open()->execute()->close()->results();

        return $this->response->success($data);
    }

    /**
     * { function_description }
     *
     * @param      string  $address  The address
     *
     * @return     bool    ( description_of_the_return_value )
     */
    public function uri($address = null)
    {
        return ($address == 'google')
        ? OSM_URL . $address
        : GOOGLE_URL . $address;
    }

}

/**
 * { item_description }
 */
Coordinate::getInstance()->get();
