<?php
/**
 * This file implements Response.
 *
 * @author     Admin
 * @since      2023
 */

class Response
{
    /**
     * { function_description }
     *
     * @param      <type>  $data    The data
     * @param      int     $code    The code
     * @param      bool    $encode  The encode
     */
    private static function json($data, $code = 500, $encode = true)
    {
        // remove any string that could create an invalid JSON
        // such as PHP Notice, Warning, logs...
        ob_clean();

        // this will clean up any previously added headers, to start clean
        header_remove();

        // Set the content type to JSON and charset
        // (charset can be set to something else)
        header("Content-type: application/json; charset=utf-8");

        // Set your HTTP response code, 2xx = SUCCESS,
        // anything else will be error, refer to HTTP documentation
        http_response_code($code);

        // encode your PHP Object or Array into a JSON string.
        // stdClass or array
        if ($encode == false) {

            $coordinates['results'] = json_decode($data['data']);

            unset($data['data']);

            echo json_encode(array_merge($coordinates, $data));

            exit();
        }
        echo json_encode($data);

        // making sure nothing is added
        exit();
    }

    /**
     * { function_description }
     *
     * @param      array   $data   The data
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function success($data = [])
    {
        return self::json([
            'status'  => 'success',
            'message' => 'Data has been fetch successfully...',
            'data'    => $data,
        ], 200, false);
    }

    /**
     * { function_description }
     *
     * @param      array   $errors  The errors
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function validator($errors = [])
    {
        return self::json([
            'status'  => 'failed',
            'message' => 'Please fill all required fields.',
            'errors'  => $errors,
        ], 400);
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function error()
    {
        return self::json([
            'status'  => 'error',
            'message' => 'Something is wrong, please try again later...',
        ], 500);
    }

}
