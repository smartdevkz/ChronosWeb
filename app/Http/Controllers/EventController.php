<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\CountryService;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $eventService;
    private $categoryService;
    private $countryService;

    function __construct(
        EventService $eventService,
        CategoryService $categoryService,
        CountryService $countryService
    ) {
        $this->eventService = $eventService;
        $this->categoryService = $categoryService;
        $this->countryService = $countryService;
    }

    public function list($categoryId = null, $countryId = null, $tags = '')
    {
        return view('events.compare');
    }

    public function index()
    {
        $events = $this->eventService->getAll();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $viewData = array();
        $viewData["categories"] = $this->categoryService->getAll();
        $viewData["countries"] = $this->countryService->getAll();

        return view('events.create', compact('viewData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $this->eventService->create($request->post());

        return redirect()->route('events.index')->with('success', 'Event has been created successfully.');
    }

    public function edit($id)
    {
        $event = $this->eventService->get($id);
        $viewData["countries"] = $this->countryService->getAll();
        $viewData["categories"] = $this->categoryService->getAll();
        return view('events.edit', compact('event', 'viewData'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'category_id' => 'required',
            'country_id' => 'required',
        ]);

        $event = $request->post();
        $event['tags'] = $this->correctTags($event['tags']);

        $this->eventService->update($event);

        return redirect()->route('events.index')->with('success', 'Event Has Been updated successfully');
    }

    function correctTags($value)
    {
        $items = explode(',', $value);
        foreach ($items as &$value) {
            $value = trim($value);
        }
        unset($value);
        return implode(',', $items);
    }

    public function destroy($id)
    {
        $this->eventService->delete($id);
        return redirect()->route('events.index')->with('success', 'Event has been deleted successfully');
    }
}
