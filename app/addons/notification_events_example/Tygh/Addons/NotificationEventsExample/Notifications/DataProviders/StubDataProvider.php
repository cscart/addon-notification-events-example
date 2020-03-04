<?php

namespace Tygh\Addons\NotificationEventsExample\Notifications\DataProviders;

use Tygh\Notifications\DataProviders\BaseDataProvider;


/**
 * Class StubDataProvider provides a data for message transports that required for sending messages
 * about events added in Notification Events Example addon.
 *
 * @package Tygh\Addons\NotificationEventsExample
 */
class StubDataProvider extends BaseDataProvider
{
    protected $lang_code = null;
    protected $company_id = 0;

    public function __construct($data)
    {
        $this->company_id = isset($data['company_id']) ? $data['company_id'] : 0;
        $data['lang_code'] = $this->getLangCode();
        $data['to'] = $this->getTo($data);
        $data['manage_urn'] = fn_url("logs.manage?q_type=general&q_action=runtime&items_per_page=1", 'A');

        parent::__construct($data);
    }

    protected function getLangCode()
    {
        if (isset($this->lang_code)) {
            return $this->lang_code;
        }

        return $this->lang_code = fn_get_company_language($this->company_id);
    }

    protected function getTo(array $data)
    {
        return [
            'admin' => $this->getAdminReceiver($data),
        ];
    }

    protected function getAdminReceiver(array $data)
    {
        $to = fn_get_user_short_info($data['user_id']);
        return $to['email'];
    }
}