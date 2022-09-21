<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    private $categoryService;

    function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $this->categoryService->create($request->post());

        return redirect()->route('categories.index')->with('success', 'Category has been created successfully.');
    }

    public function edit($id)
    {
        $category = $this->categoryService->get($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $this->categoryService->update($request->post());

        return redirect()->route('categories.index')->with('success', 'Category Has Been updated successfully');
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('categories.index')->with('success', 'Category has been deleted successfully');
    }
}
