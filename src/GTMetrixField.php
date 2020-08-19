<?php

namespace Marshmallow\GTMetrix;

use Laravel\Nova\Fields\Field;

class GTMetrixField extends Field
{
    public $component = 'marshmallow-gtmetrix-field';

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->setMeta();
    }

    public function setMeta()
    {
        return $this->withMeta(
            array_merge(config('gtmetrix.field'), [

            ])
        );
    }

    public function resolveAttribute($resource, $attribute = null)
    {
        if ($resource->gtmetrixable->count()) {
            $metric =$resource->gtmetrixable->last();
            return $metric;
        }
        return null;
    }
}
