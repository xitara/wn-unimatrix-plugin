<?php

namespace Xitara\Unimatrix;

use Backend\Facades\Backend;
use Backend\Models\UserRole;
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
        return []; // Remove this line to activate

        return [
            'xitara.unimatrix.some_permission' => [
                'tab' => 'xitara.unimatrix::lang.plugin.name',
                'label' => 'xitara.unimatrix::lang.permissions.some_permission',
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER],
            ],
        ];
    }

    /**
     * Registers backend navigation items for this plugin.
     */
    public function registerNavigation(): array
    {
        return []; // Remove this line to activate

        return [
            'unimatrix' => [
                'label'       => 'xitara.unimatrix::lang.plugin.name',
                'url'         => Backend::url('xitara/unimatrix/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['xitara.unimatrix.*'],
                'order'       => 500,
            ],
        ];
    }
}
