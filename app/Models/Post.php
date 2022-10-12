<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const FILLABLE = [
        'title',
        'slug',
        'body',
        'img',
        'started_at',
        'ended_at'
    ];

    const RELATIONS = ['user','categories'];

    const CACHE_PREFIX_FOR_ALL = "posts_";
    const CACHE_TIME = 3600;

    protected $fillable = self::FILLABLE;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopePostInCategory(Builder $query, string $catId): Builder
    {
        $cat = Category::query()
            ->where('id','=',$catId)
            ->with('posts')
            ->firstOrFail();
        $postIds = $cat->posts->pluck('id')->toArray();
        return $query->whereIn('id',$postIds);
    }
}
