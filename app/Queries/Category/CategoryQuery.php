<?php

namespace App\Queries\Category;

use App\Models\Category;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Category::query();

        parent::__construct($query);

        $this->allowedIncludes([
            'users'
        ]);

        $this->allowedSorts(['id','title']);

        $this->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('title'),
        ]);

        $this->defaultSort('id');
    }
}
