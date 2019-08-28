<?php

namespace Tygh\Addons\NotificationEventsExample;

use Tygh\Notifications\Messages\IMessage;

/**
 * Class StubMessage represents a message that is "sent" via the Stub transport when the Stub event is triggered.
 *
 * @package Tygh\Addons\NotificationEventsExample
 */
class StubMessage implements IMessage
{
    /** @var int */
    protected $random_number;

    /** @var int */
    protected $current_timestamp;

    public function __construct($random_number, $current_timestamp)
    {
        $this->random_number = $random_number;
        $this->current_timestamp = $current_timestamp;
    }

    public static function createFromStubEvent($event_data, $auth)
    {
        return new static($event_data['random_number'], $event_data['current_timestamp']);
    }

    public function getRandomNumber()
    {
        return $this->random_number;
    }

    public function getCurrentTimestamp()
    {
        return $this->current_timestamp;
    }
}
