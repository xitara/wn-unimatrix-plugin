<?php

return [
    'plugin' => [
        'name' => 'Unimatrix',
        'description' => 'Kein Beschreibungstext vorhanden.',
    ],
    'submenu' => [
        'label' => 'Unimatrix',
        'links' => 'Links',
        'link_pages' => 'Link-Seiten',
    ],
    'components' => [
        'link_page_buttons' => [
            'name' => 'Link-Seiten Buttons',
            'description' => 'Rendert die Buttons einer ausgewählten Link-Seite aus der gespeicherten Struktur.',
            'inactive' => 'Inaktiv',
            'properties' => [
                'link_page' => [
                    'title' => 'Link-Seite',
                    'description' => 'Wählt den Eintrag aus den Link-Seiten aus.',
                ],
            ],
        ],
    ],
    'tabs' => [
        'details' => 'Details',
        'additional' => 'Zusätzliches',
    ],
    'permissions' => [
        'access_links' => 'Links verwalten',
        'access_link_pages' => 'Link-Seiten verwalten',
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
            'icon' => 'Icon',
        ],
        'types' => [
            'webspace' => 'Webspace',
            'host' => 'Host',
            'docker' => 'Docker',
            'external' => 'Extern',
        ],
    ],
    'link_pages' => [
        'builder' => [
            'add_section' => 'Bereich hinzufügen',
            'available_links' => 'Vorhandene Links',
            'available_links_comment' => 'Links per Drag & Drop in die Bereiche ziehen. Ein Link kann mehrfach verwendet werden.',
            'drop_here' => 'Link hier ablegen',
            'empty' => 'Noch keine Bereiche vorhanden.',
            'inactive' => 'Inaktiv',
            'move_section' => 'Bereich verschieben',
            'move_section_here' => 'Bereich hierhin verschieben',
            'no_links' => 'Keine Links vorhanden.',
            'preview' => ':count Bereiche definiert',
            'remove_section' => 'Bereich löschen',
            'section_description' => 'Bereichsbeschreibung',
            'section_title' => 'Bereichsüberschrift',
        ],
        'columns' => [
            'title' => 'Titel',
            'slug' => 'Slug',
            'is_active' => 'Aktiv',
            'updated_at' => 'Aktualisiert',
        ],
        'fields' => [
            'title' => 'Titel',
            'slug' => 'Slug',
            'description' => 'Kurzbeschreibung',
            'is_active' => 'Aktiv',
            'structure' => 'Struktur',
        ],
    ],
];
