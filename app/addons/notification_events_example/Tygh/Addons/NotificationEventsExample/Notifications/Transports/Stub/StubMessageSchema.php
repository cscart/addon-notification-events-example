<?php

namespace Tygh\Addons\NotificationEventsExample\Notifications\Transports\Stub;

use Tygh\Notifications\Transports\BaseMessageSchema;

/**
 * Class StubMessageSchema represents a schema that is "sent" via the Stub transport when the Stub event is triggered.
 *
 * @package Tygh\Addons\NotificationEventsExample
 */
class StubMessageSchema extends BaseMessageSchema
{
    /** @var int */
    protected $random_number;

    /** @var int */
    protected $current_timestamp;

    public static function create(array $schema)
    {
        $self = new self();

        $self->random_number = self::get($schema, 'random_number');
        $self->current_timestamp = self::get($schema, 'current_timestamp');

        return $self;
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
