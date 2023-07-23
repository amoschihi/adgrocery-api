<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['getMaterials']]);
    }

    public function getMaterials()
    {
        return response()->json(Material::all());
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $material = Material::findOrFail($input['id']);
        $material->name = $input['name'];
        $material->save();

        return response()->json(['message' => true]);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $material = new Material();
        $material->name = $input['name'];
        $material->save();

        return response()->json(['message' => true, 'data' => $material]);
    }

    public function delete($id)
    {
        Material::find($id)->delete();
        return response()->json(['message' => true]);
    }
}
