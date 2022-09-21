<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    function getAll()
    {
        return Category::orderBy('id', 'desc')->paginate(5);
    }
}
