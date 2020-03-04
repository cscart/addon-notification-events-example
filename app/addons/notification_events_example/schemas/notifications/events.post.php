<?php

use Tygh\Addons\NotificationEventsExample\Events;
use Tygh\Addons\NotificationEventsExample\Receivers;
use Tygh\Addons\NotificationEventsExample\Notifications\DataProviders\StubDataProvider;
use Tygh\Enum\NotificationSeverity;
use Tygh\Enum\RecipientSearchMethods;
use Tygh\Notifications\DataValue;
use Tygh\Notifications\Transports\Internal\InternalTransport;
use Tygh\Notifications\Transports\Mail\MailTransport;
use Tygh\Notifications\Transports\Mail\MailMessageSchema;
use Tygh\Notifications\Transports\Internal\InternalMessageSchema;
use Tygh\NotificationsCenter\NotificationsCenter;
use Tygh\Enum\UserTypes;
use Tygh\Addons\NotificationEventsExample\Notifications\Transports\Stub\StubMessageSchema;
use Tygh\Addons\NotificationEventsExample\Notifications\Transports\Stub\StubTransport;

defined('BOOTSTRAP') or die('Access denied');

/** @var array $schema */
$schema[Events::STUB] = [
    // group ID
    'group'     => 'notification_events_example.event.group.stub',
    // data to populate the event name
    'name'      => [
        'template' => 'notification_events_example.event.stub',
        'params'   => [
            '[product]' => PRODUCT_NAME,
        ],
    ],
    'data_provider' => [StubDataProvider::class, 'factory'],
    // event notification receivers
    'receivers' => [
        // administrator
        UserTypes::ADMIN => [
            // notify via mail
            MailTransport::getId()     => MailMessageSchema::create([
                'area' => 'A',
                'from' => 'default_company_orders_department',
                'template_code' => 'notification_events_example_stub',
                'language_code' => DataValue::create('lang_code', CART_LANGUAGE),
                'to' => DataValue::create('to.admin', 'company_users_department'),
                'data_modifier' => function (array $data) {
                    $user_info  = fn_get_user_info($data['user_id']);

                    return array_merge($data, [
                        'user_info' => $user_info,
                    ]);
                }
            ]),
            // notify via the Notification center
            InternalTransport::getId() => InternalMessageSchema::create([
                'tag'                       => NotificationsCenter::TAG_OTHER,
                'area'                      => 'A',
                'section'                   => NotificationsCenter::SECTION_ADMINISTRATION,
                'recipient_search_method'   => RecipientSearchMethods::USER_ID,
                'recipient_search_criteria' => DataValue::create('user_id'),
                'language_code'             => DataValue::create('lang_code'),
                'action_url'                => DataValue::create('manage_urn'),
                'severity'                  => NotificationSeverity::WARNING,
                'title'                     => [
                    'template' => 'notification_events_example.notification.title',
                    'params'   => []
                ],
                'message'                   => [
                    'template' => 'notification_events_example.notification.message',
                    'params'   => [
                        '[random_number]'     => DataValue::create('random_number'),
                        '[current_timestamp]' => DataValue::create('current_timestamp'),
                    ]
                ]
            ]),
        ],
        // stub
        Receivers::STUB  => [
            // notify via the Stub transport
            StubTransport::getId() => StubMessageSchema::create([
                'random_number'     => DataValue::create('random_number'),
                'current_timestamp' => DataValue::create('current_timestamp')
            ]),
        ],
    ],
];

return $schema;
