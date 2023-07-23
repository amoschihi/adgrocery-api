<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function get()
    {
        $user = auth()->user();
        $profile = $user->profile()->first();
        $addresses = $profile->addresses()->get();
        return response()->json($addresses);
    }

    public function getAPro()
    {
        $user = auth()->user();
        $profile = $user->profile()->first();
        $addresse = $profile->addresses()->where(['type' => 'pro'])->first();
        return response()->json($addresse);
    }

    public function getAPer()
    {
        $user = auth()->user();
        $profile = $user->profile()->first();
        $addresses = $profile->addresses()->where(['type' => 'per'])->first();
        return response()->json($addresses);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $address = Address::findOrFail($input['id']);
        $address->LName = $input['LName'];
        $address->FName = $input['FName'];
        $address->phone = $input['phone'];
        $address->address = $input['address'];
        $address->info = $input['info'];
        $address->region_id = $input['region_id'];
        $address->city_id = $input['city_id'];
        $address->save();

        return response()->json(['message' => true]);
    }

}

?>