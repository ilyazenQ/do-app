<?php

namespace Tests\Feature\Post;

use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\QueryBuilder\QueryBuilder;
use Tests\Factories\Category\CategoryFactory;
use Tests\Factories\Post\PostFactory;
use Tests\Factories\User\UserFactory;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private string $token;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = UserFactory::new()->create();
        $this->token = JWTAuth::fromUser($this->user);
    }

    public function test_post_can_store()
    {
        $cat = CategoryFactory::new()->create();
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])->post('api/post/store',
            [
                'title' => 'title',
                'slug' => 'slug',
                'body' => 'body',
                'img' => 'img',
                'categories' => [
                    $cat->id
                ]
            ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data'
            ]);

        $this->assertEquals($response['data']['slug'], 'slug');
    }

    public function test_post_can_update()
    {
        $post = PostFactory::new()->create();
        $cat = CategoryFactory::new()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->patch("api/post/update/{$post->id}",
                [
                    'title' => 'titleNew',
                    'slug' => 'slugNEw',
                    'categories' => [
                        $cat->id
                    ]
                ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);

        $this->assertEquals($response['data']['title'], 'titleNew');
    }

    public function test_post_can_show()
    {
        $post = PostFactory::new()->create();

        $response = $this->get("api/post/show/{$post->id}");

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);

        $this->assertEquals($response['data']['title'], $post->title);
    }

    public function test_posts_can_filter()
    {
        $post = PostFactory::new()->create();
        $post2 = PostFactory::new()->create(
            [
                'slug' => 'newslug2'
            ]
        );
        $post3 = PostFactory::new()->create(
            [
                'slug' => 'newslug23'
            ]
        );

        $relatedThroughPivotModel = CategoryFactory::new()->create();

        $post->categories()->attach($relatedThroughPivotModel->id);

        $queryBuilderResult = QueryBuilder::for($relatedThroughPivotModel->posts())->get();

        $this->assertEquals(count($queryBuilderResult), 1);
    }

}

