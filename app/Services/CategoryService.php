<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    function getAll()
    {
        return Category::orderBy('id', 'desc')->paginate(2);
    }

    function get($id)
    {
        return Category::find($id);
    }

    function create($category)
    {
        Category::create($category);
    }

    function update($postedCategory)
    {
        $old = $this->get($postedCategory["id"]);
        $old->fill($postedCategory)->save();
    }

    function delete($id)
    {
        $category = $this->get($id);
        $category->delete();
    }
}
