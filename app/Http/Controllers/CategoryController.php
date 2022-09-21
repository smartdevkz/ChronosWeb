<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate(5);
        return view('categories.index', compact('categories'));
    }
}
