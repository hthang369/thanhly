<?php

return [
/*
     * Sections list screens
     */
    'sections' => [
        ['name'=> 'admin', 'code' => 'admin', 'url' => '', 'api' => 'admin'],
        ['name'=> 'home', 'code' => 'home', 'url' => '', 'api' => 'home'],
        ['name'=> 'setting', 'code' => 'setting', 'url' => '', 'api' => 'setting'],
        ['name'=> 'menus', 'code' => 'menus', 'url' => '', 'api' => 'menus'],
        ['name'=> 'categories', 'code' => 'categories', 'url' => '', 'api' => 'categoríes'],
        ['name'=> 'posts', 'code' => 'posts', 'url' => '', 'api' => 'posts'],
        ['name'=> 'news', 'code' => 'news', 'url' => '', 'api' => 'news'],
        ['name'=> 'pages', 'code' => 'pages', 'url' => '', 'api' => 'pages'],
        ['name'=> 'products', 'code' => 'products', 'url' => '', 'api' => 'products'],
        ['name'=> 'brands', 'code' => 'brands', 'url' => '', 'api' => 'brands'],
        ['name'=> 'employee', 'code' => 'employee', 'url' => 'employee', 'api' => 'employees'],
        ['name'=> 'slides', 'code' => 'slides', 'url' => '', 'api' => 'slides'],
        ['name'=> 'advertises', 'code' => 'advertises', 'url' => '', 'api' => 'advertises'],
        ['name'=> 'role', 'code' => 'role', 'url' => '', 'api' => 'api/v1/role'],
        ['name'=> 'role has permissions', 'code' => 'role_has_permissions', 'parent' => 'role', 'url' => '', 'api' => 'api/v1/role_has_permissions'],
        ['name'=> 'profile', 'code' => 'profile', 'url' => '', 'api' => 'api/v1/employee/profile'],
        ['name'=> 'media', 'code' => 'media', 'url' => '', 'api' => 'media'],
        ['name'=> 'users', 'code' => 'users', 'url' => '', 'api' => 'users'],
        ['name'=> 'widget', 'code' => 'widget', 'url' => '', 'api' => 'widget'],
        ['name'=> 'contact', 'code' => 'contact', 'url' => '', 'api' => 'contact'],
        ['name'=> 'tags', 'code' => 'tags', 'url' => '', 'api' => 'tags'],
        ['name'=> 'attributes', 'code' => 'attributes', 'url' => '', 'api' => 'attributes'],
        ['name'=> 'uoms', 'code' => 'uoms', 'url' => '', 'api' => 'uoms'],
        ['name'=> 'currencies', 'code' => 'currencies', 'url' => '', 'api' => 'currencies'],
        ['name'=> 'promotions', 'code' => 'promotions', 'url' => '', 'api' => 'promotions'],
        ['name'=> 'variants', 'code' => 'variants', 'url' => '', 'api' => 'variants'],
    ],
    /*
     * permission actions
     */
    'actions' => ['public', 'view', 'add', 'edit', 'delete', 'download', 'upload', 'print'],

    /**
     * Some sections only have a few actions, list them here
     */
    'section_action' => [
        'profile'                  => ['view', 'add'],
        'admin'                    => ['view'],
        'home'                     => ['view', 'add'],
        'setting'                  => ['public', 'view', 'add', 'edit', 'delete'],
        'menus'                    => ['public', 'view', 'add', 'edit', 'delete'],
        'categories'               => ['public', 'view', 'add', 'edit', 'delete'],
        'posts'                    => ['public', 'view', 'add', 'edit', 'delete'],
        'news'                     => ['public', 'view', 'add', 'edit', 'delete'],
        'pages'                    => ['public', 'view', 'add', 'edit', 'delete'],
        'products'                 => ['public', 'view', 'add', 'edit', 'delete'],
        'brands'                   => ['public', 'view', 'add', 'edit', 'delete'],
        'employee'                 => ['view', 'add', 'edit', 'delete'],
        'slides'                   => ['public', 'view', 'add', 'edit', 'delete'],
        'advertises'               => ['public', 'view', 'add', 'edit', 'delete'],
        'role'                     => ['view', 'add', 'edit', 'delete'],
        'role_has_permissions'     => ['view', 'add', 'edit', 'delete'],
        'users'                    => ['view', 'add', 'edit', 'delete'],
        'widget'                   => ['view', 'add', 'edit'],
        'tags'                     => ['view', 'add', 'edit', 'delete'],
        'attributes'               => ['public', 'view', 'add', 'edit', 'delete'],
        'contact'                  => ['view', 'add', 'edit', 'delete'],
        'uoms'                     => ['view', 'add', 'edit', 'delete'],
        'currencies'               => ['view', 'add', 'edit', 'delete'],
        'promotions'               => ['view', 'add', 'edit', 'delete'],
        'variants'                 => ['view', 'add', 'edit', 'delete'],
    ],

    'custom_section_action' => [
    ],

    /*
     * Abilities: maps action controller with permission actions
     */
    'abilities' =>  [
        'index'     => 'view',
        'edit'      => 'edit',
        'show'      => 'view',
        'update'    => 'edit',
        'create'    => 'add',
        'store'     => 'add',
        'destroy'   => 'delete',
        'download'  => 'download',
        'upload'    => 'upload',
        'print'     => 'print',
        'sort'      => 'edit'
    ],
    /*
     * Roles default
     */
    'roles' => [
        //important !! index 0 need be System Admin, will set all permissions by default
        ['level' => 'L1', 'name' => 'System Admin', 'description' => '', 'guard_name'=> 'web'],
        ['level' => 'L2', 'name' => 'Admin', 'description' => '', 'guard_name'=> 'web'],
        ['level' => 'L3', 'name' => 'Manager', 'description' => '', 'guard_name'=> 'web'],
        ['level' => 'L4', 'name' => 'Staff', 'description' => '', 'guard_name'=> 'web'],
    ],

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'user_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'user_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',
    ],

    /*
     * When set to true, the required permission names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to the exception
     * message. This could be considered an information leak in some contexts, so
     * the default setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     */

    'enable_wildcard_permission' => false,

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * When checking for a permission against a model by passing a Permission
         * instance to the check, this key determines what attribute on the
         * Permissions model is used to cache against.
         *
         * Ideally, this should match your preferred way of checking permissions, eg:
         * `$user->can('view-posts')` would be 'name'.
         */

        'model_key' => 'name',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],
];
