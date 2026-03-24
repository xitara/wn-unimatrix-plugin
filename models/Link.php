<?php namespace Xitara\Unimatrix\Models;

use Model;

/**
 * Link model represents a single directory entry.
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string $link_type
 * @property string|null $host
 * @property int|null $port
 * @property string|null $proxy_config
 * @property string|null $docker_stack
 * @property string|null $description
 * @property bool $is_active
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Winter\Storm\Database\Collection<int, static> all($columns = ['*'])
 * @method static \Winter\Storm\Database\Collection<int, static> get($columns = ['*'])
 * @method static \Winter\Storm\Database\Builder|Link lists(string $column, string $key = null)
 * @method static \Winter\Storm\Database\Builder|Link newModelQuery()
 * @method static \Winter\Storm\Database\Builder|Link newQuery()
 * @method static \Winter\Storm\Database\Builder|Link orSearchWhere(string $term, string $columns = [], string $mode = 'all')
 * @method static \Winter\Storm\Database\Builder|Link query()
 * @method static \Winter\Storm\Database\Builder|Link searchWhere(string $term, string $columns = [], string $mode = 'all')
 * @method static \Winter\Storm\Database\Builder|Link whereCreatedAt($value)
 * @method static \Winter\Storm\Database\Builder|Link whereDescription($value)
 * @method static \Winter\Storm\Database\Builder|Link whereDockerStack($value)
 * @method static \Winter\Storm\Database\Builder|Link whereHost($value)
 * @method static \Winter\Storm\Database\Builder|Link whereId($value)
 * @method static \Winter\Storm\Database\Builder|Link whereIsActive($value)
 * @method static \Winter\Storm\Database\Builder|Link whereLinkType($value)
 * @method static \Winter\Storm\Database\Builder|Link wherePort($value)
 * @method static \Winter\Storm\Database\Builder|Link whereProxyConfig($value)
 * @method static \Winter\Storm\Database\Builder|Link whereSortOrder($value)
 * @method static \Winter\Storm\Database\Builder|Link whereTitle($value)
 * @method static \Winter\Storm\Database\Builder|Link whereUpdatedAt($value)
 * @method static \Winter\Storm\Database\Builder|Link whereUrl($value)
 * @mixin \Eloquent
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
