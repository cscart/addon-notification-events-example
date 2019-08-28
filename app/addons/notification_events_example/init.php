<?php

use Tygh\Addons\NotificationEventsExample\ServiceProvider;

defined('BOOTSTRAP') or die('Access denied');

fn_register_hooks(
    'get_notification_rules'
);

Tygh::$app->register(new ServiceProvider());
