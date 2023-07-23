<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api', 'admin']);
    }

    public function get(Request $request)
    {/*->with(["article.images"])*/

        $cmd = Order::where('status', $request->status)->orderBy($request->sortAct, $request->sort);

        $cmd->whereHas('profile', function ($query) use ($request) {
            $query->whereHas('addresses', function ($query2) use ($request) {
                $query2->where('LName', 'like', $request->filter . '%')->orWhere('FName', 'like', $request->filter . '%');
            });
        });
        return response()->json($cmd->with(["payment", "delivery.deliveryType", "profile.addresses.city", "profile.addresses.region", "line_orders.product.article.images", "line_orders.product.discount"])->paginate($request->perPage));

    }


    public function getById($id)
    {/*->with(["article.images"])*/

        $cmd = Order::with(["payment", "delivery.deliveryType", "profile.addresses.city", "profile.addresses.region", "line_orders.product.article.images", "line_orders.product.discount"])->find($id);

        if ($cmd == null)
            return null;
        return response()->json($cmd);
        // return response()->json($request);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $order = Order::findOrFail($input['id']);
        $order->status = $input['status'];
        $order->save();

        return response()->json(['message' => true]);
    }

    public function delete($id)
    {
        Order::find($id)->delete();
        return response()->json(['message' => true]);
    }

}
