<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return $countries;
    }

    public function show($id)
    {
        $country = Country::find($id);
        return $country;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $country = Country::create($data);
        return $country;
    }
}
