<?php

namespace App\Http\Controllers;

use App\Models\DeliveryType;
use Illuminate\Http\Request;

class deliveryTypeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['get']]);
    }

    public function get()
    {
        return response()->json(DeliveryType::all());
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $deliveryType = DeliveryType::findOrFail($input['id']);
        $deliveryType->name = $input['name'];
        $deliveryType->info = $input['info'];
        $deliveryType->save();

        return response()->json(['message' => true]);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $deliveryType = new DeliveryType();
        $deliveryType->name = $input['name'];
        $deliveryType->info = $input['info'];

        $deliveryType->save();

        return response()->json(['message' => true, 'data' => $deliveryType]);
    }

    public function delete($id)
    {
        DeliveryType::find($id)->delete();
        return response()->json(['message' => true]);
    }
}
