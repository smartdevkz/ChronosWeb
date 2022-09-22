<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    public function index(Request $request)
    {
        $res = Event::where('id', '>', 0);

        $categoryIds = !empty($request->categoryIds) ? explode(',', $request->categoryIds) : array();

        if (sizeof($categoryIds) > 0) {
            $res = $res->whereIn('category_id', $categoryIds);
        }

        $countryIds = !empty($request->countryIds) ? explode(',', $request->countryIds) : array();

        if (sizeof($countryIds) > 0) {
            $res = $res->whereIn('country_id', $countryIds);
        }

        $events = array();
        foreach ($res->orderBy('start_date_int', 'DESC')->get() as $item) {
            $key = $item->start_date_str;
            $items = array_key_exists($key, $events) ? $events[$key] : array();
            foreach ($countryIds as $countryId) {
                if (!array_key_exists($countryId, $items)) $items[$countryId] = null;
            }

            $items[$item->country_id] = $this->map_to($item);
            $items['start_date_str'] = $item->start_date_str;
            $events[$key] = $items;
        }

        $headers = ['Content-Type' => 'application/json; charset=utf-8'];
        return response()->json($events, 200, $headers, JSON_UNESCAPED_UNICODE);
    }

    function map_to($item)
    {
        $obj = new class
        {
        };
        $columns = array('id', 'description');
        foreach ($columns as $c) {
            $obj->$c = $item->$c;
        }
        return $obj;
    }
}
