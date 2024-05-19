<?php

return [
    [
        'menu_title' => 'admin::menus.dashboard',
        'menu_name' => 'admin',
        'menu_link' => 'admin.index',
        'menu_icon' => 'nav-icon fa fa-tachometer',
        'actived' => '',
        'section' => 'admin',
        'visiable' => true,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.manager_posts',
        'menu_name' => 'posts.*',
        'menu_link' => 'posts.index',
        'menu_icon' => 'nav-icon fa fa-edit',
        'menu_id'   => 'manager_posts',
        'actived' => '',
        'section' => 'posts',
        'visiable' => false,
        'children' => [
            [
                'menu_title' => 'admin::menus.categories',
                'menu_name' => 'categories.*',
                'menu_link' => 'categories.post.index',
                'menu_icon' => 'nav-icon fa fa-list-alt',
                'actived' => '',
                'section' => 'categories',
                'visiable' => false,
                'children' => []
            ],
            [
                'menu_title' => 'admin::menus.tags',
                'menu_name' => 'tags.*',
                'menu_link' => 'tags.index',
                'menu_icon' => 'nav-icon fa fa-list-alt',
                'actived' => '',
                'section' => 'tags',
                'visiable' => false,
                'children' => []
            ],
            [
                'menu_title' => 'admin::menus.posts',
                'menu_name' => 'posts.*',
                'menu_link' => 'posts.index',
                'menu_icon' => 'nav-icon fa fa-edit',
                'actived' => '',
                'section' => 'posts',
                'visiable' => false,
                'children' => []
            ]
        ]
    ],
    [
        'menu_title' => 'admin::menus.manager_news',
        'menu_name' => 'news.*',
        'menu_link' => 'news.index',
        'menu_icon' => 'nav-icon fa fa-newspaper-o',
        'menu_id'   => 'manager_news',
        'actived' => '',
        'section' => 'news',
        'visiable' => false,
        'children' => [
            [
                'menu_title' => 'admin::menus.categories',
                'menu_name' => 'categories.*',
                'menu_link' => 'categories.news.index',
                'menu_icon' => 'nav-icon fa fa-list-alt',
                'actived' => '',
                'section' => 'categories',
                'visiable' => false,
                'children' => []
            ],
            [
                'menu_title' => 'admin::menus.news',
                'menu_name' => 'news.*',
                'menu_link' => 'news.index',
                'menu_icon' => 'nav-icon fa fa-newspaper-o',
                'actived' => '',
                'section' => 'news',
                'visiable' => false,
                'children' => []
            ]
        ]
    ],
    [
        'menu_title' => 'admin::menus.manager_products',
        'menu_name' => 'products.*',
        'menu_link' => 'products.index',
        'menu_icon' => 'nav-icon fa fa-newspaper-o',
        'menu_id'   => 'manager_products',
        'actived' => '',
        'section' => 'products',
        'visiable' => false,
        'children' => [
            [
                'menu_title' => 'admin::menus.categories',
                'menu_name' => 'categories.*',
                'menu_link' => 'categories.products.index',
                'menu_icon' => 'nav-icon fa fa-list-alt',
                'actived' => '',
                'section' => 'categories',
                'visiable' => false,
            ],
            [
                'menu_title' => 'admin::menus.brands',
                'menu_name' => 'brands.*',
                'menu_link' => 'brands.index',
                'menu_icon' => 'nav-icon fa fa-list-alt',
                'actived' => '',
                'section' => 'brands',
                'visiable' => false,
            ],
            [
                'menu_title' => 'admin::menus.uoms',
                'menu_name' => 'uoms.*',
                'menu_link' => 'uoms.index',
                'menu_icon' => 'nav-icon fa fa-list-alt',
                'actived' => '',
                'section' => 'uoms',
                'visiable' => false,
            ],
            [
                'menu_title' => 'admin::menus.currencies',
                'menu_name' => 'currencies.*',
                'menu_link' => 'currencies.index',
                'menu_icon' => 'nav-icon fa fa-list-alt',
                'actived' => '',
                'section' => 'currencies',
                'visiable' => false,
            ],
            [
                'menu_title' => 'admin::menus.promotions',
                'menu_name' => 'promotions.*',
                'menu_link' => 'promotions.index',
                'menu_icon' => 'nav-icon fa fa-list-alt',
                'actived' => '',
                'section' => 'promotions',
                'visiable' => false,
            ],
            [
                'menu_title' => 'admin::menus.variants',
                'menu_name' => 'variants.*',
                'menu_link' => 'variants.index',
                'menu_icon' => 'nav-icon fa fa-list-alt',
                'actived' => '',
                'section' => 'variants',
                'visiable' => false,
            ],
            [
                'menu_title' => 'admin::menus.products',
                'menu_name' => 'products.*',
                'menu_link' => 'products.index',
                'menu_icon' => 'nav-icon fa fa-newspaper-o',
                'actived' => '',
                'section' => 'products',
                'visiable' => false,
            ]
        ]
    ],
    [
        'menu_title' => 'admin::menus.pages',
        'menu_name' => 'pages.*',
        'menu_link' => 'pages.index',
        'menu_icon' => 'nav-icon fa fa-book',
        'actived' => '',
        'section' => 'pages',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.menus',
        'menu_name' => 'menus.*',
        'menu_link' => 'menus.index',
        'menu_icon' => 'nav-icon fa fa-list',
        'actived' => '',
        'section' => 'menus',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.setting',
        'menu_name' => 'setting.*',
        'menu_link' => 'setting.index',
        'menu_icon' => 'nav-icon fa fa-cogs',
        'actived' => '',
        'section' => 'setting',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.attribute',
        'menu_name' => 'attribute.*',
        'menu_link' => 'attribute.index',
        'menu_icon' => 'nav-icon fa fa-cogs',
        'actived' => '',
        'section' => 'attribute',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.slides',
        'menu_name' => 'slides.*',
        'menu_link' => 'slides.index',
        'menu_icon' => 'nav-icon fa fa-sliders',
        'actived' => '',
        'section' => 'slides',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.advertises',
        'menu_name' => 'advertises.*',
        'menu_link' => 'advertises.index',
        'menu_icon' => 'nav-icon fa fa-sliders',
        'actived' => '',
        'section' => 'advertises',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.role',
        'menu_name' => 'role.*',
        'menu_link' => 'role.index',
        'menu_icon' => 'nav-icon fa fa-user-md',
        'actived' => '',
        'section' => 'role',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.users',
        'menu_name' => 'users.*',
        'menu_link' => 'users.index',
        'menu_icon' => 'nav-icon fa fa-users',
        'actived' => '',
        'section' => 'users',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.contact',
        'menu_name' => 'contact.*',
        'menu_link' => 'contact.index',
        'menu_icon' => 'nav-icon fa fa-youtube-play',
        'actived' => '',
        'section' => 'contact',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.media',
        'menu_name' => 'media.*',
        'menu_link' => 'media.index',
        'menu_icon' => 'nav-icon fa fa-youtube-play',
        'actived' => '',
        'section' => 'employee',
        'visiable' => false,
        'children' => []
    ],
    [
        'menu_title' => 'admin::menus.widget',
        'menu_name' => 'widget.*',
        'menu_link' => 'widget.index',
        'menu_icon' => 'nav-icon fa fa-cubes',
        'actived' => '',
        'section' => 'widget',
        'visiable' => false,
        'children' => []
    ],
];
