<?php

namespace App\Http\Controllers;

use App\Models\InfoSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class InfoSiteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'], ['except' => ['get']]);
    }

    public function get()
    {
        $info = InfoSite::all()->first();
        return response()->json($info);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $info = InfoSite::all()->first();
        $info->tel = $input['tel'];
        $info->name = $input['name'];
        $info->fax = $input['fax'];
        $info->address = $input['address'];
        $info->x = $input['x'];
        $info->y = $input['y'];
        $info->serviceStart = $input['serviceStart'];
        $info->serviceEnd = $input['serviceEnd'];
        $info->email = $input['email'];
        $info->save();

        return response()->json($info);
    }


}

?>