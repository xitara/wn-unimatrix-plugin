<?php namespace Xitara\Unimatrix\Models;

use Model;

/**
 * Link model represents a single directory entry.
 */
class Link extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string the database table used by the model
     */
    protected $table = 'xitara_unimatrix_links';

    /**
     * @var array attributes that are mass assignable
     */
    protected $fillable = [
        'title',
        'url',
        'link_type',
        'host',
        'port',
        'proxy_config',
        'docker_stack',
        'description',
        'is_active',
        'sort_order',
    ];

    /**
     * @var array attribute casting rules
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'port' => 'integer',
    ];

    /**
     * @var array validation rules
     */
    public $rules = [
        'title' => 'required|max:255',
        'url' => 'required|max:2048',
        'link_type' => 'required|max:32',
    ];
}
