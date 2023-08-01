<?php

return [
    'page_name' => 'VNNIT COMPUTER',
    'bootstrap' => 4,
    'pagination' => [
        'onEachPage' => 1, // Số trang hiển thị 2 bên trang hiện tại
        'numberFirstPage' => 1, // Số trang đầu tiên cân hiển thị,
        'numberLastPage' => 1, // Số trang cuối cân hiển thị
        'perPage' => 20,
    ],
    'pager' => [
        'allowedPageSizes' => [10, 15, 20, 30, 50, 100],
        'showPageSizeSelector' => true,
        'showInfo' => true,
        'infoText' => 'table.show_result'
    ],
    'table' => [
        'sticky_header' => false,
        'header_variant' => 'dark'
    ],
    'time_expired_code' => 300,
    'cache_expire' => 10,
    'views' => [
        'index'     => '%s.list',
        'create'    => '%s.modify_modal',
        'edit'      => '%s.modify_modal',
        'show'      => '%s.modify_modal'
    ],
    'views_temp' => [
        'index'     => 'admin::layouts.template.list',
        'create'    => 'admin::layouts.template.modify_modal',
        'edit'      => 'admin::layouts.template.modify_modal',
        'show'      => 'admin::layouts.template.modify_modal',
        'sort'      => 'admin::layouts.template.sort'
    ],
    'logo' => 'images/kbank_logo_new.svg'
];
