<?php

namespace Marshmallow\GTMetrix\Facades;

use Illuminate\Support\Facades\Facade;
use Marshmallow\GTMetrix\GTMetrixHelper;

class GTMetrix extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GTMetrixHelper::class;
    }
}
