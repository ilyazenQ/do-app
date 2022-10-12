<?php

namespace Tests\Factories\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Tests\Factories\FactoryInterface;

class PostFactory implements FactoryInterface
{
    public static function new(): self
    {
        return new self();
    }


    public function create(array $data = [], array $extra = []): Model
    {
        $model = Post::create([
                'title' => $data['title'] ?? 'title',
                'slug' => $data['slug']  ?? 's',
                'body' => $data['body']  ?? 'b',
                'img' => $data['img']  ?? 'i',
                'ended_at' => $data['ended_at'] ?? null,
            ] + $extra);



        return $model->refresh();
    }
}
