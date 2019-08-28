<?php

use Tygh\Addons\NotificationEventsExample\Events;
use Tygh\Addons\NotificationEventsExample\Receivers;
use Tygh\Addons\NotificationEventsExample\StubInternalMessage;
use Tygh\Addons\NotificationEventsExample\StubMailMessage;
use Tygh\Addons\NotificationEventsExample\StubMessage;
use Tygh\Addons\NotificationEventsExample\StubTransport;
use Tygh\Enum\UserTypes;
use Tygh\Notifications\Transports\InternalTransport;
use Tygh\Notifications\Transports\MailTransport;

defined('BOOTSTRAP') or die('Access denied');

/** @var array $schema */
$schema[Events::STUB] = [
    // unique event idenfifier
    'id'        => Events::STUB,
    // group ID
    'group'     => 'notification_events_example.event.group.stub',
    // data to populate the event name
    'name'      => [
        'template' => 'notification_events_example.event.stub',
        'params'   => [
            '[product]' => PRODUCT_NAME,
        ],
    ],
    // event notification receivers
    'receivers' => [
        // administrator
        UserTypes::ADMIN => [
            // notify via mail
            MailTransport::getId()     => [StubMailMessage::class, 'createFromStubEvent'],
            // notify via the Notification center
            InternalTransport::getId() => [StubInternalMessage::class, 'createFromStubEvent'],
        ],
        // stub
        Receivers::STUB  => [
            // notify via the Stub transport
            StubTransport::getId() => [StubMessage::class, 'createFromStubEvent'],
        ],
    ],
];

return $schema;
