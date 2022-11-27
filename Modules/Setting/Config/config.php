<?php

use Modules\Setting\Enums\SettingGroup;

return [
    'name' => 'Setting',
    'settings' => [
        SettingGroup::INFO => [
            'web_name' => '',
            'web_phone' => '',
            'web_email' => '',
            'web_address' => '',
            'ob_title' => '',
            'ob_keyword' => '',
            'ob_description' => '',
        ],
        SettingGroup::HOME => [
            'web_favicon' => '',
            'web_logo' => '',
            'web_banner' => '',
            'menu_type' => ''
        ],
        SettingGroup::MAP => [
            'web_map' => ''
        ],
        SettingGroup::WIDGET => [
            'text_copyright' => '',
            'text_footer' => '',
            'text_ournews' => '',
            'text_footer_info' => '',
            'group_navbar_top' => json_encode(['slot_1', 'slot_2']),
            'group_navbar_bottom' => json_encode(['slot_1']),
            'group_footer' => json_encode(['slot_1', 'slot_2', 'slot_3', 'slot_4']),
        ],
        SettingGroup::WIDGET_CONFIG => [
            'group_navbar_top' => json_encode(['xs' => 1, 'sm' => 2]),
            'group_navbar_bottom' => json_encode(['xs' => 1]),
            'group_footer' => json_encode(['xs' => 1, 'sm' => 4]),
        ],
    ]
];
