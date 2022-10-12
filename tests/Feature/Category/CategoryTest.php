<?php

namespace Tests\Feature\Category;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\QueryBuilder\QueryBuilder;
use Tests\Factories\Category\CategoryFactory;
use Tests\Factories\Post\PostFactory;
use Tests\Factories\User\UserFactory;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;


class CategoryTest extends TestCase
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

    public function test_category_can_store()
    {

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->token])
            ->post('api/category/store',
            [
                'title' => 'titleCat',
            ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data'
            ]);

        $this->assertEquals($response['data']['title'], 'titleCat');
    }


    public function test_category_can_show()
    {
        $cat = CategoryFactory::new()->create();

        $response = $this->get("api/category/show/{$cat->id}");

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);

        $this->assertEquals($response['data']['title'], $cat->title);
    }

    public function test_category_can_filter()
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

        $category = CategoryFactory::new()->create();

        $post->categories()->attach($category->id);
        $post2->categories()->attach($category->id);

        $req = new Request([
            'include' => [
                'posts'
            ],
        ]);

        $queryBuilderResult = QueryBuilder::for($category,$req)
            ->allowedIncludes(['posts'])
            ->get();

        $this->assertEquals(count($queryBuilderResult[0]->posts), 2);
        $this->assertEquals($queryBuilderResult[0]->id, $category->id);
    }
}
