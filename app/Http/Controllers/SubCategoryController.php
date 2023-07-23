<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['getSubCategories']]);
    }

    public function getSubCategories()
    {
        return response()->json(SubCategory::all());
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $subCategory = SubCategory::findOrFail($input['id']);
        $subCategory->name = $input['name'];
        $subCategory->category_id = $input['category_id'];
        $subCategory->save();

        return response()->json(['message' => true]);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $subCategory = new SubCategory();
        $subCategory->name = $input['name'];
        $subCategory->category_id = $input['category_id'];
        $subCategory->save();

        return response()->json(['message' => true, 'data' => $subCategory]);
    }

    public function delete($id)
    {
        SubCategory::find($id)->delete();
        return response()->json(['message' => true]);
    }
}
