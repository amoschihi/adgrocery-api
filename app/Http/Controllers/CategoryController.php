<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['getCategories']]);
    }

    public function getCategories()
    {
        // return response()->json(Category::all());
        return response()->json(Category::with('subCategories')->get());
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $category = Category::findOrFail($input['id']);
        $category->name = $input['name'];
        $category->sex = $input['sex'];
        $category->save();

        return response()->json(['message' => true]);
    }

    public function save(Request $request)
    {
        try {
            $input = $request->all();
            $category = new Category();
            $category->name = $input['name'];
            $category->sex = $input['sex'];
            $res = $category->save();
            return response()->json(['res' => $res, 'data' => $category], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], Response::HTTP_NOT_FOUND);
        }
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return response()->json(['message' => true]);
    }
}
