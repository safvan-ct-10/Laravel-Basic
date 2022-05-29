<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderby('name', 'asc')->paginate(10);
        return view('admin.country.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.country.create');
    }

    public function store(StoreCountryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'code' => $request->code,
        ];

        Country::create($data);

        return  redirect()->route('admin.country')->with('success', 'Country Created Successfully');
    }

    public function edit(Country $country)
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $data = [
            'name' => $request->name,
            'code' => $request->code,
        ];

        $country->update($data);

        return  redirect()->route('admin.country')->with('success', 'Country Updated Successfully');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return  redirect()->route('admin.country')->with('success', 'Country Deleted Successfully');
    }
}
