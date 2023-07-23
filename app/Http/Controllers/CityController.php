<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['getCities']]);
    }

    public function getCities()
    {
        return response()->json(City::all());
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $city = City::findOrFail($input['id']);
        $city->name = $input['name'];
        $city->save();

        return response()->json(['message' => true]);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $city = new City();
        $city->name = $input['name'];
        $city->save();

        return response()->json(['message' => true, 'data' => $city]);
    }

    public function delete($id)
    {
        City::find($id)->delete();
        return response()->json(['message' => true]);
    }
}
