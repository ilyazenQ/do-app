<?php

namespace App\Queries\Post;

use App\Models\Post;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Post::query();

        parent::__construct($query);

        $this->allowedIncludes([
            'user', 'categories'
        ]);

        $this->allowedSorts(['id', 'user_id', 'started_at', 'ended_at']);

        $this->allowedFilters([
            AllowedFilter::scope('post_in_category'),
            AllowedFilter::exact('id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('slug'),
            AllowedFilter::exact('title'),
        ]);

        $this->defaultSort('id');
    }
}
