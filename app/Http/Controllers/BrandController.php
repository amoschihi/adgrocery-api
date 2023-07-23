<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['getBrands']]);
    }

    public function getBrands()
    {
        return response()->json(Brand::all());
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $brand = Brand::findOrFail($input['id']);
        $brand->name = $input['name'];
        $brand->save();

        return response()->json(['message' => true]);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $brand = new Brand();
        $brand->name = $input['name'];
        $brand->save();

        return response()->json(['message' => true, 'data' => $brand]);
    }

    public function delete($id)
    {
        Brand::find($id)->delete();
        return response()->json(['message' => true]);
    }
}
