<?php

namespace Marshmallow\GTMetrix\Traits;

use Marshmallow\GTMetrix\Models\GTMetrix as GTMetrixModel;

trait GTMetrix
{
    public function gtmetrixable()
    {
        return $this->morphMany(GTMetrixModel::class, 'gtmetrixable');
    }

    abstract public function getFullPublicPath();
}
