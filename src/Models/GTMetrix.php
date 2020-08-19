<?php

namespace Marshmallow\GTMetrix\Models;

use Illuminate\Database\Eloquent\Model;

class GTMetrix extends Model
{
    /**
     * Guarded variables
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Hidden variables
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * Table name for the model
     *
     * @var string
     */
    protected $table = 'gtmetrixable';

    /**
     * Get the owning seo_metaable model.
     *
     * @return morphTo
     */
    public function gtmetrixable()
    {
        return $this->morphTo();
    }
}
