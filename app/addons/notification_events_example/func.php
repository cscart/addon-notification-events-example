<?php

use Tygh\Addons\NotificationEventsExample\Receivers;

defined('BOOTSTRAP') or die('Access denied');

/**
 * Hook handler: adds new receiver types.
 *
 * @param array      $force_notification
 * @param array|bool $params
 * @param bool       $disable_notification
 */
function fn_notification_events_example_get_notification_rules(&$force_notification, $params, $disable_notification)
{
    $force_notification[Receivers::STUB] = false;
}
