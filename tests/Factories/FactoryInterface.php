<?php

namespace Tests\Factories;

use Illuminate\Database\Eloquent\Model;

interface FactoryInterface
{
    public function create(array $data, array $extra):Model;
}
