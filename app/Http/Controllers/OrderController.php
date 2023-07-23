<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Order;
use App\Models\LineOrder;
use App\Models\Delivery;
use App\Models\Payment;
use App\Notifications\OrderNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function get(Request $request)
    {
        $user = auth()->user();
        $profile = $user->profile()->first();
        $order = $profile->commandes()
            ->where('status', $request->status)
            ->orderBy($request->sortAct, $request->sort)
            ->with(["payment",
                    "delivery.deliveryType",
                    "profile.addresses.city",
                    "profile.addresses.region",
                    "line_orders.product.article.images",
                    "line_orders.product.discount"])
            ->paginate($request->perPage);

        return response()->json($order);
    }

    public function saveCash(Request $request)
    {
        $res = DB::transaction(function () use ($request) {
            $res = array();
            $input = $request->all();
            $user = auth()->user();
            $profile = $user->profile()->first();
            $order = new Order();
            $order->total = $request->total;
            $order->profile_id = $profile->id;
            $order->status = $request->status;
            $order->dateC = new \DateTime();
            $order->save();
            $delivery = new Delivery();
            $delivery->deliveryType_id = $input['delivery']['deliveryType_id'];
            $order->delivery()->save($delivery);

            $payment = new Payment();
            $payment->type = $input['payment']['type'];
            $payment->profile_id = $profile->id;
            $order->payment()->save($payment);

            $line_orders = $input['line_orders'];

            foreach ($line_orders as $line_order) {
                $lc = LineOrder::find($line_order['id']);
                $lc->order_id = $order->id;
                $lc->subTotal = $line_order['subTotal'];
                $article = Article::where('product_id', $line_order['product_id'])->first();
                $article->stock -= $line_order['quantity'];
                $article->save();
                $res[] = $article;
                $lc->save();
            }
            /*  $admin = User::whereHas('roles', function ($query) use ($input) {
                  $query->where('name', 'admin');
              })->get();
              Notification::send($admin, new OrderNotification($order));*/
            $newRes = ['articles' => $res, 'idCmd' => $order->id];
            return $newRes;
        });

        return response()->json($res);
    }


}
