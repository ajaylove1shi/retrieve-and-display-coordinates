<?php
/**
 * This file implements Curl.
 *
 * @author     Admin
 * @since      2023
 */

class  Curl
{
	/**
	 * [$results description]
	 * @var [type]
	 */
    protected $results;

    /**
     * [$url description]
     * @var [type]
     */
    protected $url;

    /**
     * [$curl description]
     * @var [type]
     */
    protected $curl;

    /**
     * { function_description }
     *
     * @param      <type>  $url    The url
     *
     * @return     self    ( description_of_the_return_value )
     */
    public function url($url = null)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function open()
    {
        $this->curl = curl_init();

        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function close()
    {
        curl_close($this->curl);

        return $this;
    }

    /**
     * { function_description }
     *
     * @return     self  ( description_of_the_return_value )
     */
    public function execute()
    {
        curl_setopt_array($this->curl, array(
            CURLOPT_URL            => $this->url,
            CURLOPT_HTTPHEADER     => $this->header(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
        ));

        $this->results = curl_exec($this->curl);

        return $this;

    }

    /**
     * { function_description }
     *
     * @return     array  ( description_of_the_return_value )
     */
    public function header()
    {
        return [
            "method" => "GET",
            "header" => "User-Agent: Nominatim-Test",
        ];

    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function results()
    {
        return $this->results;
    }
}
