<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

abstract class AbstractCacheService
{

    public function rememberForIndex(Model $model)
    {
        $key = request()->get('page', 1);

        return Cache::remember($model::CACHE_PREFIX_FOR_ALL . "$key", $model::CACHE_TIME,
            function () use ($model) {
                return $model->with($model::RELATIONS)->paginate(2);
            });
    }

    public function deleteForIndex(Model $model)
    {
        $models = Cache::get($model::CACHE_PREFIX_FOR_ALL . '1');
        if ($models) {
            $lastPage = $models->lastPage();
            for ($i = 1; $i <= $lastPage; $i++) {
                Cache::forget($model::CACHE_PREFIX_FOR_ALL . $i);
            }
        }
    }
}
