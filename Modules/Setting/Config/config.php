<?php

use Modules\Setting\Enums\SettingGroup;

return [
    'name' => 'Setting',
    'settings' => [
        // SettingGroup::INFO => [
        //     'web_name' => '',
        //     'web_phone' => '',
        //     'web_email' => '',
        //     'web_address' => '',
        //     'ob_title' => '',
        //     'ob_keyword' => '',
        //     'ob_description' => '',
        // ],
        // SettingGroup::HOME => [
        //     'web_favicon' => '',
        //     'web_logo' => '',
        //     'web_banner' => '',
        //     'menu_type' => ''
        // ],
        // SettingGroup::MAP => [
        //     'web_map' => ''
        // ],
        SettingGroup::WIDGET => [
            'text_copyright' => '',
            'text_footer' => '',
            'text_ournews' => '',
            'text_top_herder' => '',
            'text_header_social' => '',
            'text_footer_social' => '',
            'group_navbar_top' => '<div class="d-flex justify-content-between">
            <div>[slot_1]</div>
            <div>[slot_2]</div>
          </div>',
            'group_navbar_bottom' => '<div class="d-flex justify-content-center"><div>[slot_1]</div></div>',
            'group_footer' => '<div class="row">
            <div class="col-12 col-md-3">[slot_1]</div>
            <div class="col-12 col-md-3">[slot_2]</div>
            <div class="col-12 col-md-3">[slot_3]</div>
            <div class="col-12 col-md-3">[slot_4]</div>
          </div>',
        ],
        SettingGroup::WIDGET_CONFIG => [
            'group_navbar_top' => json_encode(['[slot_1]' => '', '[slot_2]' => '']),
            'group_navbar_bottom' => json_encode(['[slot_1]' => '']),
            'group_footer' => json_encode(['[slot_1]' => '', '[slot_2]' => '', '[slot_3]' => '', '[slot_4]' => '']),
        ],
    ]
];
