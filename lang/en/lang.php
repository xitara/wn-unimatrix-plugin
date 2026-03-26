<?php

return [
    'plugin' => [
        'name' => 'Unimatrix',
        'description' => 'Managed links for infrastructure resources.',
    ],
    'submenu' => [
        'label' => 'Unimatrix',
        'links' => 'Links',
        'link_pages' => 'Link Pages',
    ],
    'components' => [
        'link_page_buttons' => [
            'name' => 'Link Page Buttons',
            'description' => 'Renders the buttons of a selected link page from its saved structure.',
            'inactive' => 'Inactive',
            'properties' => [
                'link_page' => [
                    'title' => 'Link page',
                    'description' => 'Selects the entry from the link pages list.',
                ],
            ],
        ],
    ],
    'permissions' => [
        'access_links' => 'Manage links',
        'access_link_pages' => 'Manage link pages',
    ],
    'tabs' => [
        'details' => 'Details',
        'additional' => 'Additional',
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
            'icon' => 'Icon',
        ],
        'types' => [
            'webspace' => 'Webspace',
            'host' => 'Host',
            'docker' => 'Docker',
            'external' => 'External',
        ],
    ],
    'link_pages' => [
        'builder' => [
            'add_section' => 'Add section',
            'available_links' => 'Available links',
            'available_links_comment' => 'Drag and drop links into sections. A link can be used multiple times.',
            'drop_here' => 'Drop link here',
            'empty' => 'No sections created yet.',
            'inactive' => 'Inactive',
            'move_section' => 'Move section',
            'move_section_here' => 'Move section here',
            'no_links' => 'No links available.',
            'preview' => ':count sections defined',
            'remove_section' => 'Remove section',
            'section_description' => 'Section description',
            'section_title' => 'Section heading',
        ],
        'columns' => [
            'title' => 'Title',
            'slug' => 'Slug',
            'is_active' => 'Active',
            'updated_at' => 'Updated',
        ],
        'fields' => [
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Short description',
            'is_active' => 'Active',
            'structure' => 'Structure',
        ],
    ],
];
