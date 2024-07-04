<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'roles' => 'c,r,u,d,s',
            'admins' => 'c,r,u,d,s,b',
            'consumers' => 'c,r,u,d,s,b',
            'suppliers' => 'c,r,u,d,s,b',
            'settings' => 'c,r,u,d',
            'backups' => 'c,r,d,dl',
            'pages' => 'c,r,u,d,s',
            'categories' => 'c,r,u,d,s',
            'countries' => 'c,r,u,d,s',
            'payment' => 'c,r,u,d,s',
            'cities' => 'c,r,u,d,s',
            'offers' => 'c,u,d,s',
            'orders' => 'c,r,u,d,s',
            'ratings' => 'c,r,u,d,s',
            'rejections' => 'c,u,d,s',
            'sections' => 'c,r,u,d,s',
            'reports' => 'r,s,d',
            'contacts' => 'r,u,d,s',
        ],
        'admin' => [],
        'office' => [
            'offers' => 'rj,a,c,s',
            'quotations' => 'c,r,u,d,s',
            'orders' => 'r,s',
            'rejections' => 'c,u',
            'consumers' => 'u,d,s',
            'drafts' => 'c,r,u,d,s',
            'chat' => 'c,r,u,d,s',
            'ratings' => 'c',
        ],
        'printing_press' => [
            'drafts' => 'c,r,u,d,s',
            'offers' => 'c,r,u,d,s',
            'requests' => 'rj,a,r,s',
            'orders' => 'c,r,u,d,s',
            'rejections' => 'c,r,u,d,s',
            'suppliers' => 'u,d,s',
            'bookmarks' => 'c,r,d',
            'chat' => 'c,r,u,d,s',
            'ratings' => 'r,s',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'a' => 'accept',
        'rj' => 'reject',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'show',
        'b' => 'block',
        'dl' => 'download',
        'so' => 'sort',
    ]
];
