<?php

namespace Akibatech\FreeMobileSms\Notifications;

/**
 * Class FreeMobileMessage
 *
 * @package Akibatech\FreeMobileSms\Notifications
 */
class FreeMobileMessage
{
    /**
     * The message content.
     *
     * @var string
     */
    public $message;

    //-------------------------------------------------------------------------

    /**
     * Create a new message instance.
     *
     * @param   string $message
     * @return  void
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    //-------------------------------------------------------------------------

    /**
     * Set the message content.
     *
     * @param   string $content
     * @return  self
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    //-------------------------------------------------------------------------
}
