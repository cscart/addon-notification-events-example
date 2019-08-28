<?php

namespace Tygh\Addons\NotificationEventsExample;

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
     * @param \Tygh\Addons\NotificationEventsExample\StubMessage $message Message
     *
     * @return bool Whether a message was successfully processed
     */
    public function process($message)
    {
        fn_log_event(
            'general',
            'runtime',
            [
                'message' => __(
                    'notification_events_example.notification.message.text',
                    [
                        '[random_number]'     => $message->getRandomNumber(),
                        '[current_timestamp]' => $message->getCurrentTimestamp(),
                    ]
                ),
            ]
        );

        return true;
    }
}
