<?php

namespace App\ModelService;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Helper;

/**
 * Auditable trait
 * this trait is responsible for any model triggering
 * use Audittable trait
 */
trait Auditable
{
    protected static function bootAuditable()
    {
        static::creating(function (Model $model) {
            if (\method_exists($model, 'cacheForget')) {
                $model->cacheForget();
            }
        });

        static::updating(function ($user) {
            //to do 
        });
    }
}
