<?php


namespace evg_dev\LightCurl;

/*
 *
 */
class Request
{
    protected $url;            // request url
    protected $fields;        // request params
    protected $ch;            // Curl object
    protected $full_response; // Full response from curl

    public $headers;
    public $body;

    /**
     * Request constructor.
     * @param null $url
     * @param array $fields
     */
    public function __construct($url = null, $fields = [])
    {
        $this->url = $url;
        $this->fields = $fields;
        $this->initCurl();
    }

    /**
     * @return bool|string
     * @throws LightCurlException
     */
    function get()
    {
        $this->curlExec();
        return $this;
    }

    /**
     * @return bool|string
     * @throws LightCurlException
     */
    function post()
    {
        $this->setOption(CURLOPT_POST, 1);
        $this->curlExec();
        return $this;
    }

    /**
     * @param $key
     * @param $value
     */
    protected function setOption($key, $value)
    {
        curl_setopt($this->ch, $key, $value);
    }

    /**
     *
     */
    protected function setDefaultOptions() {
        $this->setOption(CURLOPT_RETURNTRANSFER, 1);
        $this->setOption(CURLOPT_HEADER, 1);
    }

    /**
     *
     */
    protected function initCurl()
    {
        $this->ch = curl_init($this->url);
    }

    /**
     * @throws LightCurlException
     */
    protected function curlExec()
    {
        $this->setDefaultOptions();
        $this->full_response = curl_exec($this->ch);

        if (curl_errno($this->ch)) {
            curl_close($this->ch);
            throw new LightCurlException(var_dump(curl_error($this->ch)));

        }

        $this->parseResponse();
        curl_close($this->ch);
    }

    /**
     *
     */
    protected function parseResponse()
    {
        $headerSize = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $this->headers = substr($this->full_response, 0, $headerSize);
        $this->body = substr($this->full_response, $headerSize);
    }
}
