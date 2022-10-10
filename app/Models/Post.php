<?php

namespace App\Models;

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
    ];

    protected $fillable = self::FILLABLE;

    public function user(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(User::class);
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
