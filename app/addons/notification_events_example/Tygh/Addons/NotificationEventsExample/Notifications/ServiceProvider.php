<?php

namespace Tygh\Addons\NotificationEventsExample\Notifications;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Tygh\Addons\NotificationEventsExample\Notifications\Transports\Stub\StubTransport;

/**
 * Class ServiceProvider registers Stub transport to be used by the Event dispatcher.
 *
 * @package Tygh\Addons\NotificationEventsExample
 */
class ServiceProvider implements ServiceProviderInterface
{
    /** @inheritDoc */
    public function register(Container $app)
    {
        $app['event.transports.stub'] = function($app) {
            return new StubTransport();
        };
    }
}