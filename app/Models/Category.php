<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tests\Factories\Category\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    const FILLABLE = [
        'title',
    ];

    const RELATIONS = ['posts'];

    const CACHE_PREFIX_FOR_ALL = "category_";
    const CACHE_TIME = 3600;

    protected $fillable = self::FILLABLE;

    protected static function newFactory()
    {
        return new CategoryFactory();
    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
