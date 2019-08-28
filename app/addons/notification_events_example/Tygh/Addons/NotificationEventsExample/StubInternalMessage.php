<?php

namespace Tygh\Addons\NotificationEventsExample;

use Tygh\Enum\NotificationSeverity;
use Tygh\Enum\RecipientSearchMethods;
use Tygh\Notifications\Messages\InternalMessage;
use Tygh\NotificationsCenter\NotificationsCenter;

/**
 * Class StubInternalMessage represents a message that will be created in the Notifications center when the Stub event
 * is triggered.
 *
 * @package Tygh\Addons\NotificationEventsExample
 */
class StubInternalMessage extends InternalMessage
{
    public function __construct($user_id, $random_number, $current_timestamp)
    {
        // search user by user ID
        $this->recipient_search_method = RecipientSearchMethods::USER_ID;
        $this->recipient_search_criteria = $user_id;

        $this->severity = NotificationSeverity::WARNING;
        $this->title = __('notification_events_example.notification.title');
        $this->message = __(
            'notification_events_example.notification.message',
            [
                '[random_number]'     => $random_number,
                '[current_timestamp]' => $current_timestamp,
            ]
        );
        $this->action_url = 'logs.manage?q_type=general&q_action=runtime&items_per_page=1';

        $this->area = 'A';
        $this->section = NotificationsCenter::SECTION_ADMINISTRATION;
        $this->tag = NotificationsCenter::TAG_OTHER;
    }

    public static function createFromStubEvent($event_data, $auth)
    {
        return new static($auth['user_id'], $event_data['random_number'], $event_data['current_timestamp']);
    }
}
