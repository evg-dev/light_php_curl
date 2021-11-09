<?php


namespace evg_dev\LightCurl;

/*
 * Use static method, and return response object class Request
 */
class LightCurl
{
    /**
     * @param null $url
     * @return string
     * @throws LightCurlException
     */
    public static function get($url = null)
    {
        $request = new Request($url);
        $request->get();
        return $request;
    }

    /**
     * @param null $url
     * @param array $fields
     * @return string
     * @throws LightCurlException
     */
    public static function post($url = null, $fields = [])
    {
        $request = new Request($url, $fields);
        $request->post();
        return $request;
    }
}