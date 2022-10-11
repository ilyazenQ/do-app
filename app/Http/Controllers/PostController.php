<?php

namespace App\Http\Controllers;

use App\Actions\Post\CreatePostAction;
use App\Actions\Post\UpdatePostAction;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PostResource::collection(Post::paginate());
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
     * @param  \Illuminate\Http\Request  $request
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
                ->where('id','=',$id)
                ->firstOrFail()
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
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
        int $id,
        UpdatePostRequest $request,
        UpdatePostAction $action): PostResource
    {
        return new PostResource($action->execute($request->validated(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
