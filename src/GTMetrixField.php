<?php

namespace Marshmallow\GTMetrix;

use Laravel\Nova\Fields\Field;

class GTMetrixField extends Field
{
    /**
     * Indicates if the element should be shown on the creation view.
     *
     * @var \Closure|bool
     */
    public $showOnCreation = false;

    /**
     * Indicates if the element should be shown on the update view.
     *
     * @var \Closure|bool
     */
    public $showOnUpdate = false;

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
                //
            ])
        );
    }

    public function resolveAttribute($resource, $attribute = null)
    {
        if ($resource->gtmetrixable && $resource->gtmetrixable->count()) {
            $metric = $resource->gtmetrixable->last();

            return $metric;
        }

        return null;
    }
}
