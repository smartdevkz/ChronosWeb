<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TagService;

class TagController extends Controller
{
    private $tagService;

    function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index()
    {
        $tags = $this->tagService->getAll();

        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $this->tagService->create($request->post());

        return redirect()->route('tags.index')->with('success', 'tag has been created');
    }

    public function edit($id)
    {
        $tags = $this->tagService->get($id);

        return view('tags.edit', compact('tags'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $this->tagService->update($request->post());

        return redirect()->route('tags.index')->with('success', 'tag updated successfully');
    }

    public function destroy($id)
    {
        $this->tagService->delete($id);

        return redirect()->route('tags.index')->with('success', 'tag deleted successfully');
    }
}
