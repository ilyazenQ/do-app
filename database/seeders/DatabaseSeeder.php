<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(2)->create();
        $posts = Post::factory(10)->create();
        $cat = Category::factory(3)->create();

        $user_ids = $users->pluck('id');
        $post_ids = $posts->pluck('id');
        $cat_ids = $cat->pluck('id');

        $posts->each(function ($post) use ($user_ids, $cat_ids) {
            $post->user()->associate($user_ids->random(1)[0]);

            $post->categories()->attach($cat_ids->random(2));
            $post->save();
        });




    }
}
