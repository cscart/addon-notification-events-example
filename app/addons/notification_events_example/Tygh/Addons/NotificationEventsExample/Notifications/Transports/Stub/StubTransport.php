<?php

namespace Tygh\Addons\NotificationEventsExample\Notifications\Transports\Stub;

use Tygh\Exceptions\DeveloperException;
use Tygh\Notifications\Transports\BaseMessageSchema;
use Tygh\Notifications\Transports\ITransport;

/**
 * Class StubTransport implements a transport that stores the event data in the logs table.
 *
 * @package Tygh\Addons\NotificationEventsExample
 */
class StubTransport implements ITransport
{
    /** @inheritDoc */
    public static function getId()
    {
        return 'stub';
    }

    /**
     * Processes a message of an event.
     *
     * @param \Tygh\Notifications\Transports\BaseMessageSchema $schema Schema
     *
     * @return bool Whether a message was successfully processed
     */
    public function process(BaseMessageSchema $schema)
    {
        if (!$schema instanceof StubMessageSchema) {
            throw new DeveloperException('Input data should be instance of StubMessageSchema');
        }

        fn_log_event(
            'general',
            'runtime',
            [
                'message' => __(
                    'notification_events_example.notification.message.text',
                    [
                        '[random_number]'     => $schema->getRandomNumber(),
                        '[current_timestamp]' => $schema->getCurrentTimestamp(),
                    ]
                ),
            ]
        );

        return true;
    }
}
