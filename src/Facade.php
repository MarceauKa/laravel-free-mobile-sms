<?php

namespace Akibatech\FreeMobileSms;

/**
 * Class Facade
 *
 * @package Akibatech\FreeMobileSms
 */
class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * @param   void
     * @return  string
     */
    protected static function getFacadeAccessor()
    {
        return 'freemobile';
    }
}