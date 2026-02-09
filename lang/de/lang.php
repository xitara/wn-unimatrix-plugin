<?php

return [
    'plugin' => [
        'name' => 'Unimatrix',
        'description' => 'Kein Beschreibungstext vorhanden.',
    ],
    'permissions' => [
        'access_links' => 'Links verwalten',
    ],
    'navigation' => [
        'links' => 'Links',
    ],
    'links' => [
        'columns' => [
            'title' => 'Titel',
            'link_type' => 'Typ',
            'host' => 'Host',
            'port' => 'Port',
            'is_active' => 'Aktiv',
            'updated_at' => 'Aktualisiert',
        ],
        'fields' => [
            'title' => 'Titel',
            'url' => 'URL',
            'link_type' => 'Link-Typ',
            'host' => 'Host',
            'port' => 'Port',
            'description' => 'Beschreibung',
            'proxy_config' => 'Proxy-Konfiguration',
            'docker_stack' => 'Docker-Stack',
            'is_active' => 'Aktiv',
            'sort_order' => 'Sortierung',
        ],
        'types' => [
            'webspace' => 'Webspace',
            'docker' => 'Docker',
            'external' => 'Extern',
        ],
    ],
];
