<?php

namespace Tygh\Addons\NotificationEventsExample;

use Tygh\Notifications\Messages\MailMessage;

/**
 * Class StubMailMessage represents a message that is sent to e-mail when the Stub event is triggered.
 *
 * @package Tygh\Addons\NotificationEventsExample
 */
class StubMailMessage extends MailMessage
{
    protected $template_code = 'notification_events_example_stub';

    protected $from = 'default_company_orders_department';

    public function __construct($email, $area, $lang_code, $event_data)
    {
        $this->to = $email;
        $this->area = $area;
        $this->data = $event_data;
        $this->language_code = $lang_code;
        $this->company_id = 0;
    }

    public static function createFromStubEvent($event_data, $auth)
    {
        $user_info = fn_get_user_info($auth['user_id']);

        return new static(
            $user_info['email'],
            $auth['area'],
            $user_info['lang_code'],
            $event_data
        );
    }
}
