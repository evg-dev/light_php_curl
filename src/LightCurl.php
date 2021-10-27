<?php


namespace evg_dev\LightCurl;

class LightCurl
{
    public static function get($url = null) {
        $request = new Request($url);
        $request->get();
        return $request;
    }

    public static function post($url = null, $fields = []) {
        $request = new Request($url, $fields);
        $request->post();
        return $request;
    }
}