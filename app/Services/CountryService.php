<?php

namespace App\Services;

use App\Models\Country;

class CountryService
{
    function getAll()
    {
        return Country::orderBy('id', 'desc')->paginate(2);
    }

    function get($id)
    {
        return Country::find($id);
    }

    function create($country)
    {
        Country::create($country);
    }

    function update($postedCountry)
    {
        $old = $this->get($postedCountry["id"]);
        $old->fill($postedCountry)->save();
    }

    function delete($id)
    {
        $country = $this->get($id);
        $country->delete();
    }
}
