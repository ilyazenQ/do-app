<?php

namespace App\Actions\Post;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Arr;

class UpdatePostAction
{
    public function execute(array $fields, int $id)
    {
        $post = Post::query()->where('id','=',$id)->firstOrFail();
        $post->update(Arr::only($fields, Post::FILLABLE));

        foreach ($fields['categories'] as $categoryId) {
            $post
                ->categories()
                ->save(Category::query()->where('id', '=', $categoryId)->firstOrFail());
        }

        $post->refresh();
        return $post;
    }
}
