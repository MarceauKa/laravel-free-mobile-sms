<?php

namespace Akibatech\FreeMobileSms;

/**
 * Class CurlClient
 *
 * @package Akibatech\FreeMobileSms
 */
class CurlClient
{
    /**
     * @var resource cURL handle
     */
    private $resource;

    /**
     * @var int
     */
    private $response;

    /**
     * Constructor.
     *
     * @param   string $url
     * @param   array  $options
     * @return  self
     */
    public function __construct($url, array $options = [])
    {
        $this->resource = curl_init();

        $query = http_build_query($options);
        $url .= '?' . $query;

        $this->addOption(CURLOPT_URL, $url);
        $this->addOption(CURLOPT_RETURNTRANSFER, false);
    }

    //-------------------------------------------------------------------------

    /**
     * Add an option.
     *
     * @param   string $key
     * @param   mixed  $value
     * @return  $this
     */
    public function addOption($key, $value)
    {
        curl_setopt($this->resource, $key, $value);

        return $this;
    }

    //-------------------------------------------------------------------------

    /**
     * Get the response
     *
     * @param   void
     * @return  int
     * @throws \RuntimeException On cURL error
     */
    public function hit()
    {
        if (is_null($this->response) === false)
        {
            return $this->response;
        }

        curl_exec($this->resource);
        $error = curl_error($this->resource);
        $errno = curl_errno($this->resource);

        $response = (int)curl_getinfo($this->resource, CURLINFO_HTTP_CODE);

        if (is_resource($this->resource))
        {
            curl_close($this->resource);
        }

        if (0 !== $errno)
        {
            throw new \RuntimeException($error, $errno);
        }

        $this->response = $response;

        return $response;
    }
}