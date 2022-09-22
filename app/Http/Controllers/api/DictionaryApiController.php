<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;

class DictionaryApiController extends Controller
{
    public function getCategories()
    {
        $data = Category::orderBy('created_at', 'desc')->get();
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        return response()->json($data, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    public function getCountries()
    {
        $data = Country::orderBy('created_at', 'desc')->get();
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        return response()->json($data, 200, $headers, JSON_UNESCAPED_UNICODE);
    }
}
