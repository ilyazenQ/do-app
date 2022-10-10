<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Support\Arr;

class CreateCategoryAction
{
    public function execute(array $fields)
    {
        return Category::create(Arr::only($fields, Category::FILLABLE));
    }
}
