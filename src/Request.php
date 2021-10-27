<?php


namespace evg_dev\LightCurl;


class Request
{
    protected $url;
    protected $fields;

    protected $ch;

    public function __construct($url = null, $fields = [])
    {
        $this->url = $url;
        $this->fields = $fields;
        $this->initCurl();
    }

    function get()
    {
        return $this->curlExec();
    }

    function post()
    {
        $this->setOption(CURLOPT_POST, 1);
        return $this->curlExec();
    }

    protected function setOption($key, $value)
    {
        curl_setopt($this->ch, $key, $value);
    }

    protected function setDefaultOptions() {
        $this->setOption(CURLOPT_RETURNTRANSFER, true);
    }

    protected function initCurl()
    {
        $this->ch = curl_init($this->url);
    }

    protected function curlExec() {
        $this->setDefaultOptions();
        $response = curl_exec($this->ch);
        return $response;
    }
}