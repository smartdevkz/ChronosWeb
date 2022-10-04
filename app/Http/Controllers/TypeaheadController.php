<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TypeaheadController extends Controller
{
    public function index()
    {
        return view('autocomplete.index');
    }
 
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Tag::where('name', 'LIKE', '%'. $query. '%')->get();

        return response()->json($filterResult);
    } 
}
