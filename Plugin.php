<?php

namespace Xitara\Unimatrix;

use App;
use Backend;
use BackendMenu;
use Event;
use System\Classes\PluginBase;
use System\Classes\PluginManager;

/**
 * Unimatrix Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     */
    public function pluginDetails() : array
    {
        return [
            'name'        => 'xitara.unimatrix::lang.plugin.name',
            'description' => 'xitara.unimatrix::lang.plugin.description',
            'author'      => 'Xitara',
            'icon'        => 'icon-leaf',
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register() : void
    {
        if (PluginManager::instance()->exists('Xitara\Nexus') === true) {
            BackendMenu::registerContextSidenavPartial(
                'Xitara.Unimatrix',
                'unimatrix',
                '$/xitara/nexus/partials/_sidebar.htm'
            );
        }
    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot() : void
    {
        /**
         * Check if we are currently in backend module.
         */
        if (!App::runningInBackend()) {
            return;
        }

        /**
         * get sidemenu if nexus-plugin is loaded
         */
        if (PluginManager::instance()->exists('Xitara.Nexus') === true) {
            Event::listen('backend.page.beforeDisplay', function ($controller, $action, $params) {
                $namespace = (new \ReflectionObject($controller))->getNamespaceName();

                if ($namespace == 'Xitara\Unimatrix\Controllers') {
                    \Xitara\Nexus\Plugin::getSideMenu('Xitara.Unimatrix', 'unimatrix');
                }
            });
        }
    }

    /**
     * Registers any frontend components implemented in this plugin.
     */
    public function registerComponents() : array
    {
        return []; // Remove this line to activate

        return [
            \Xitara\Unimatrix\Components\MyComponent::class => 'myComponent',
        ];
    }

    /**
     * Registers any backend permissions used by this plugin.
     */
    public function registerPermissions() : array
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
    public function registerNavigation()
    {
        $label = 'xitara.unimatrix::lang.plugin.name';

        if (PluginManager::instance()->exists('Xitara.Nexus') === true) {
            $label .= '::hidden';
        }

        return [
            'unimatrix' => [
                'label' => $label,
                'url' => Backend::url('xitara/unimatrix/links'),
                'icon' => 'icon-leaf',
                'permissions' => ['xitara.unimatrix.*'],
                'order' => 500,
            ],
        ];
    }

    /**
     * inject into sidemenu
     *
     * @author mburghammer
     * @date 2020-09-22T15:17:28+02:00
     * @see Xitara\Nexus::getSideMenu
     * @return array sidemenu-data
     */
    public static function injectSideMenu()
    {
        $i = 0;

        return [
            'unimatrix.links' => [
                'label' => 'xitara.unimatrix::lang.submenu.links',
                'url' => Backend::url('xitara/unimatrix/links'),
                'icon' => 'icon-link',
                'permissions' => ['xitara.unimatrix.*'],
                'attributes' => [
                    'group' => 'xitara.unimatrix::lang.submenu.label',
                ],
                'order' => \Xitara\Nexus\Plugin::getMenuOrder('xitara.unimatrix') + $i++,
            ],
        ];
    }
}
