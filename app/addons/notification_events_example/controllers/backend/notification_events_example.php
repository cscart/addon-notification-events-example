<?php

use Tygh\Addons\NotificationEventsExample\Events;
use Tygh\Enum\NotificationSeverity;

defined('BOOTSTRAP') or die('Access denied');

if ($mode === 'trigger_event') {

    $auth = Tygh::$app['session']['auth'];
    /** @var \Tygh\Notifications\EventDispatcher $dispatcher */
    $dispatcher = Tygh::$app['event.dispatcher'];
    $dispatcher->dispatch(Events::STUB, [
        'random_number'     => rand(),
        'current_timestamp' => time(),
        'user_id'           => $auth['user_id']
    ]);

    fn_set_notification(
        NotificationSeverity::NOTICE,
        '',
        __('notification_events_example.event_triggered')
    );
}

return [CONTROLLER_STATUS_REDIRECT, 'index.index'];
