<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;

class rateController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['get', 'get2']]);
    }

    public function get($id)
    {
        return response()->json(Rate::where('deliveryType_id', $id)->with(['city'])->get());
    }

    public function get2(Request $request)
    {
        return response()->json(Rate::where('deliveryType_id', $request['id'])->where('city_id', $request['v_id'])->first());
//        return response()->json(Rate::whereColumn([['deliveryType_id', $request['id']], ['city_id', $request['v_id']]])->first());
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $rate = Rate::findOrFail($input['id']);
        $rate->amount = $input['amount'];
        $rate->deliveryType_id = $input['deliveryType_id'];
        $rate->city_id = $input['city_id'];
        $rate->save();

        return response()->json(['message' => true]);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $rate = new Rate();
        $rate->amount = $input['amount'];
        $rate->deliveryType_id = $input['deliveryType_id'];
        $rate->city_id = $input['city_id'];
        $rate->save();

        return response()->json(['message' => true, 'data' => $rate]);
    }

    public function delete($id)
    {
        Rate::find($id)->delete();
        return response()->json(['message' => true]);
    }
}
