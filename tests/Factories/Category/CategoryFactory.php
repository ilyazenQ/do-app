<?php

namespace Tests\Factories\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Tests\Factories\FactoryInterface;

class CategoryFactory implements FactoryInterface
{

    public static function new(): self
    {
        return new self();
    }


    public function create(array $data = [], array $extra = []): Model
    {
        $model = Category::create([
                'title' => $data['title'] ?? 'testTitle',
            ] + $extra);

        return $model->refresh();
    }
}
