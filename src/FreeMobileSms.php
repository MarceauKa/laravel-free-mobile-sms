<?php

namespace Akibatech\FreeMobileSms;

/**
 * Class FreeMobileSms
 *
 * @package Akibatech\FreeMobileSms
 */
class FreeMobileSms
{
    /**
     * API endpoint.
     *
     * @var string
     */
    protected static $endpoint = 'https://smsapi.free-mobile.fr/sendmsg';

    /**
     * @var array
     */
    private $credentials = [
        'user' => null,
        'pass' => null
    ];

    //-------------------------------------------------------------------------

    /**
     * FreeMobileSms constructor.
     *
     * @param   void
     * @return  self
     */
    public function __construct(array $credentials = [])
    {
        $credentials = collect($credentials);

        if ($credentials->isEmpty() === false)
        {
            $this->credentials = collect($credentials)->only([
                'user',
                'pass',
            ]);
        }
        else
        {
            $this->loadCredentialsFromConfig();
        }
    }

    //-------------------------------------------------------------------------

    /**
     * Load API credentials from Laravel config.
     *
     * @param   void
     * @return  self
     */
    protected function loadCredentialsFromConfig()
    {
        $this->credentials['user'] = config('laravel-free-mobile-sms.user');
        $this->credentials['pass'] = config('laravel-free-mobile-sms.pass');

        return $this;
    }

    //-------------------------------------------------------------------------

    /**
     * Create the CurlClient client.
     *
     * @param   void
     * @return  CurlClient
     */
    protected function newClient($message)
    {
        $client = new CurlClient(self::$endpoint, [
            'user' => $this->credentials['user'],
            'pass' => $this->credentials['pass'],
            'msg'  => $message
        ]);

        return $client;
    }

    //-------------------------------------------------------------------------

    /**
     * Send a new message.
     *
     * @param   string $message
     * @return  int
     */
    public function send($message = '')
    {
        $return = $this->newClient($message)->hit();

        return $return;
    }

    //-------------------------------------------------------------------------
}