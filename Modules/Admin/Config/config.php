<?php

return [
    'name' => 'Admin',
    'menu_type' => [
        'main' => 'main_menu',
        'footer' => 'footer_menu',
        'footerOur' => 'footer_our_menu',
    ],
    'partial_type' => [
        'page'  => 'page_link',
        'post'  => 'post_link',
        'news'  => 'news_link',
        'category'  => 'category_link',
        'external'  => 'external_link'
    ],
    'partial_table' => [
        'page' => \Modules\Admin\Repositories\Pages\PagesRepository::class,
        'post' => \Modules\Admin\Repositories\Posts\PostsRepository::class,
        'news' => \Modules\Admin\Repositories\News\NewsRepository::class,
        'category' => \Modules\Admin\Repositories\Categories\CategoriesRepository::class,
    ],
    'breadcrumb' => [
        'admin' => [
            'index' => [
                'link' => null,
            ]
        ],
        'categories' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'posts' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'news' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'pages' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'menus' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ],
            'sort' => [
                'link' => null,
                'parent' => ['admin.index', 'menus.index']
            ]
        ],
        'setting' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'slides' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'advertises' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'role' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ],
        ],
        'role_has_permissions' => [
            'show' => [
                'link' => null,
                'parent' => ['admin.index', 'role.index']
            ]
        ],
        'users' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'media' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'widget' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
        'contact' => [
            'index' => [
                'link' => null,
                'parent' => ['admin.index']
            ]
        ],
    ]
];
