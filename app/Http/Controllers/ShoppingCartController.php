<?php

namespace App\Http\Controllers;

use App\Models\LineOrder;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShoppingCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function get(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile()->first();
        return response()->json(LineOrder::with(["product.article.images", "product.discount"])->where('profile_id', $profile->id)->whereNull('order_id')->get());
    }

    public function save(Request $request)
    {
        try {
            $user = auth()->user();
            $profile = $user->profile()->first();
            $LC = new LineOrder();
            $LC->quantity = $request->quantity;
            $LC->subTotal = $request->subTotal;
            $LC->product_id = $request->product_id;
            $LC->profile_id = $profile->id;

            $res = $LC->save();
            return response()->json($res, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request)
    {
        try {
            $LC = LineOrder::find($request->id);
            $LC->quantity = $request->quantity;
            $res = $LC->save();
            return response()->json($res, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], Response::HTTP_NOT_FOUND);
        }
    }

    public function delete($id)
    {
        $res = LineOrder::find($id)->delete();
        return response()->json($res);
    }

    public function deleteAll()
    {
        $user = auth()->user();
        $profile = $user->profile()->first();
        $res = LineOrder::with(["product.article.images"])->where('profile_id', $profile->id)->whereNull('order_id')->delete();
        return response()->json($res);
    }
}
