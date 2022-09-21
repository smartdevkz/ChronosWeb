<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Services\CountryService;

class CountryController extends Controller
{
    //
    private $countryService;

    function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        $countries = $this->countryService->getAll();

        return view('countries.index', compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $this->countryService->create($request->post());

        return redirect()->route('countries.index')->with('success', 'Country created succesfully');
    }

    public function edit($id)
    {
        $country = $this->countryService->get($id);
        
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $this->countryService->update($request->post());

        return redirect()->route('countries.index')->with('success', 'Country updated successfully');
    }

    public function destroy($id)
    {
        $this->countryService->delete($id);

        return redirect()->route('countries.index')->with('success', 'country has been deleted successfully');
    }
}
