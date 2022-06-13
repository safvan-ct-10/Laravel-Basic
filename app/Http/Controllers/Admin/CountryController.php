<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use DataTables;

class CountryController extends Controller
{
    public function index()
    {
        return view('admin.country.index');
    }

    public function resluts()
    {
        $data = Country::select('*');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $edit = route('admin.country.edit', $row->id);
                $delete = route('admin.country.delete', $row->id);

                $btn = '<a href="'.$edit.'" class="btn btn-info">Edit</a>
                <a href="'.$delete.'" class="btn btn-danger">Delete</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
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

        return redirect()->route('admin.country')->with('success', 'Country Created Successfully');
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

        return redirect()->route('admin.country')->with('success', 'Country Updated Successfully');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('admin.country')->with('success', 'Country Deleted Successfully');
    }
}
