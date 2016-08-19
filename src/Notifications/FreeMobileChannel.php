<?php

namespace Akibatech\FreeMobileSms\Notifications;

use Akibatech\FreeMobileSms\FreeMobileSms;
use Akibatech\FreeMobileSms\Notifications\FreeMobileMessage;
use Illuminate\Notifications\Notification;

/**
 * Class FreeMobileChannel
 *
 * @package Akibatech\FreeMobileSms\Notifications
 */
class FreeMobileChannel
{
    /**
     * @var FreeMobileSms
     */
    protected $client;

    //-------------------------------------------------------------------------

    /**
     * FreeMobileChannel constructor.
     *
     * @return  self
     */
    public function __construct(FreeMobileSms $client)
    {
        $this->client = $client;
    }

    //-------------------------------------------------------------------------

    /**
     * Send the given notification.
     *
     * @param   mixed  $notifiable
     * @param   \Illuminate\Notifications\Notification  $notification
     * @return  bool
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFreeMobile($notifiable);

        return $this->client->send($message->message) === 200;
    }

    //-------------------------------------------------------------------------
}
