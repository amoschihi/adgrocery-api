<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin']);
    }

    public function get()
    {
        return response()->json(Discount::all());
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $discount = Discount::findOrFail($input['id']);
        $discount->percentageValue = $input['percentageValue'];
        $discount->save();

        return response()->json(['message' => true]);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $discount = new Discount();
        $discount->percentageValue = $input['percentageValue'];
        $discount->save();

        return response()->json(['message' => true, 'data' => $discount]);
    }

    public function delete($id)
    {
        Discount::find($id)->delete();
        return response()->json(['message' => true]);
    }
}
