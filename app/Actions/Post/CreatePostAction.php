<?php

namespace App\Actions\Post;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Arr;

class CreatePostAction
{
    public function execute(array $fields)
    {
        $post = Post::create(Arr::only($fields, Post::FILLABLE));

        $post->user_id = auth()->user()->id;
        $post->save();

        foreach ($fields['categories'] as $categoryId) {
            $post
                ->categories()
                ->save(Category::query()->where('id', '=', $categoryId)->firstOrFail());
        }

        $post->refresh();
        return $post;
    }
}
