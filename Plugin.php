<?php

namespace Xitara\Unimatrix;

use Backend\Facades\Backend;
use System\Classes\PluginBase;

/**
 * Unimatrix Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'xitara.unimatrix::lang.plugin.name',
            'description' => 'xitara.unimatrix::lang.plugin.description',
            'author'      => 'Xitara',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register(): void
    {

    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot(): void
    {

    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents(): array
    {
        return []; // Remove this line to activate

        return [
            \Xitara\Unimatrix\Components\MyComponent::class => 'myComponent',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions(): array
    {
        return [
            'xitara.unimatrix.access_links' => [
                'tab' => 'xitara.unimatrix::lang.plugin.name',
                'label' => 'xitara.unimatrix::lang.permissions.access_links',
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return [
            'unimatrix' => [
                'label'       => 'xitara.unimatrix::lang.navigation.links',
                'url'         => Backend::url('xitara/unimatrix/links'),
                'icon'        => 'icon-link',
                'permissions' => ['xitara.unimatrix.access_links'],
                'order'       => 500,
            ],
        ];
    }
}
