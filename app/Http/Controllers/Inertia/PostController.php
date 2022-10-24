<?php

namespace App\Http\Controllers\Inertia;

use App\Actions\Post\CreatePostAction;
use App\Actions\Post\UpdatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Queries\Post\PostQuery;
use App\Services\Post\CachePostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(CachePostService $service)
    {
        $posts = PostResource::collection($service->rememberForIndex(new Post()));
        return Inertia::render('Do-app/Index', [
                    'canLogin' => true,
                    'canRegister' => true,
                    'posts' => $posts
        ]);
    }

    /**
     * Can filter posts
     *
     * @param PostQuery $query
     * @return AnonymousResourceCollection
     */
    public function search(PostQuery $query): AnonymousResourceCollection
    {
        return PostResource::collection($query->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return PostResource
     */
    public function store(CreatePostRequest $request, CreatePostAction $action): PostResource
    {
        return new PostResource($action->execute($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PostResource
     */
    public function show(int $id): PostResource
    {
        return new PostResource(
            Post::query()
                ->where('id', '=', $id)
                ->firstOrFail()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param UpdatePostRequest $request
     * @param UpdatePostAction $action
     * @return PostResource
     */
    public function update(
        int               $id,
        UpdatePostRequest $request,
        UpdatePostAction  $action): PostResource
    {
        return new PostResource($action->execute($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
