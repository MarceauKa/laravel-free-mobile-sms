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
     * @var mixed The response
     */
    private $response = false;

    /**
     * Constructor.
     *
     * @param   string  $url
     * @param   array   $options
     * @return  self
     */
    public function __construct($url, array $options = [])
    {
        $this->resource = curl_init($url);

        $this->addOption(CURLOPT_RETURNTRANSFER, true);
        $this->addOptions($options);
    }

    //-------------------------------------------------------------------------

    /**
     * Add an option.
     *
     * @param   string $key
     * @param   mixed $value
     * @return  $this
     */
    public function addOption($key, $value)
    {
        curl_setopt($this->resource, $key, $value);

        return $this;
    }

    //-------------------------------------------------------------------------

    /**
     * Add many options.
     *
     * @param   array $options
     * @return  $this
     */
    public function addOptions(array $options = [])
    {
        if (count($options) > 0)
        {
            foreach ($options as $key => $value)
            {
                $this->addOption($key, $value);
            }
        }

        return $this;
    }

    //-------------------------------------------------------------------------

    /**
     * Get the response
     *
     * @param void
     * @return string
     * @throws \RuntimeException On cURL error
     */
    public function getResponse()
    {
        if ($this->response)
        {
            return $this->response;
        }

        $response = curl_exec($this->resource);
        $error    = curl_error($this->resource);
        $errno    = curl_errno($this->resource);

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