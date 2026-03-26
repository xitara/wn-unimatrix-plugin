<?php

namespace Xitara\Unimatrix\Models;

use Model;
use Xitara\Nexus\Plugin as Xitara;

/**
 * LinkPage model stores a structured set of sections and links for later frontend rendering.
 *
 * @property int                             $id
 * @property string                          $title
 * @property string|null                     $slug
 * @property string|null                     $description
 * @property array|null                      $structure
 * @property bool                            $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class LinkPage extends Model
{
    use \Winter\Storm\Database\Traits\Validation;

    /**
     * @var string the database table used by the model
     */
    protected $table = 'xitara_unimatrix_link_pages';

    /**
     * @var array attributes that are mass assignable
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'structure',
        'is_active',
    ];

    /**
     * @var array attribute casting rules
     */
    protected $casts = [
        'structure' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * @var array validation rules
     */
    public $rules = [
        'title' => 'required|max:255',
        'slug' => 'nullable|max:255',
    ];

    public function beforeSave()
    {
        if ($this->slug == '') {
            $this->slug = Xitara::slug($this->title);
        }
    }

    /**
     * Ensure the structure always contains the expected root node.
     */
    public function beforeValidate()
    {
        if (!\is_array($this->structure) || !\array_key_exists('sections', $this->structure)) {
            $this->structure = [
                'sections' => [],
            ];
        }
    }
}
