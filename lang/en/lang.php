<?php

return [
    'plugin' => [
        'name' => 'Unimatrix',
        'description' => 'Managed links for infrastructure resources.',
    ],
    'permissions' => [
        'access_links' => 'Manage links',
    ],
    'navigation' => [
        'links' => 'Links',
    ],
    'links' => [
        'columns' => [
            'title' => 'Title',
            'link_type' => 'Type',
            'host' => 'Host',
            'port' => 'Port',
            'is_active' => 'Active',
            'updated_at' => 'Updated',
        ],
        'fields' => [
            'title' => 'Title',
            'url' => 'URL',
            'link_type' => 'Link Type',
            'host' => 'Host',
            'port' => 'Port',
            'description' => 'Description',
            'proxy_config' => 'Proxy Config',
            'docker_stack' => 'Docker Stack',
            'is_active' => 'Active',
            'sort_order' => 'Sort Order',
        ],
        'types' => [
            'webspace' => 'Webspace',
            'docker' => 'Docker',
            'external' => 'External',
        ],
    ],
];
