<?php namespace Xitara\Unimatrix\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

/**
 * Links Back-end Controller
 */
class Links extends Controller
{
    /**
     * Implement list and form behaviors
     */
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
    ];

    /**
     * Configuration files
     */
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    /**
     * Required permissions to access controller
     */
    public $requiredPermissions = ['xitara.unimatrix.access_links'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Xitara.Unimatrix', 'unimatrix', 'links');
    }
}
