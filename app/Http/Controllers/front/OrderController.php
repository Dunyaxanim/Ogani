<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Basket;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\OrderStatus;

class OrderController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $itemes = Basket::where("user_id", $userId)->with('product')->get();
        $total = Basket::where("user_id", $userId)->sum('total');
        return view('front.pages.check-out', ["itemes" => $itemes, 'total' => $total]);
    }
    public function myorders()
    {
        $userId = Auth::user()->id;
        $itemes = Order::where("user_id", $userId)->with('orderItems.product')->get();
        return view('front.pages.order-list', ["items" => $itemes]);
    }
    public function orderPost(OrderRequest $orderRequest)
    {
        $userId = Auth::user()->id;
        $total = Basket::where("user_id", $userId)->sum('total');
        $itemes = Basket::where("user_id", $userId)->with('product')->get();

        $user = auth()->user();
        try {

            DB::beginTransaction();
            $order = new Order();
            $order->user_id = $userId;
            $order->total = $total;
            $order->address = $orderRequest->address;
            $order->phone = $orderRequest->phone;
            $order->status= OrderStatus::PROCESS->value;
            $order->save();
            $orderItems = [];
            foreach ($itemes as $basketItem) {
                $orderItems[] = [
                    'order_id' => $order->id,
                    'product_id' => $basketItem->product_id,
                    'qty' => $basketItem->count,
                    'price' => $basketItem->total,
                    'sub_total' => $basketItem->total
                ];
            }
            OrderItem::insert($orderItems);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        Basket::where("user_id", $userId)->delete();
        return redirect()->back();
    }
    public function delete($id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== auth()->user()->id) {
            abort(403);
        }
        $order->status=0;
        $order->save();
        return redirect()->route('profile')->with('success', 'Deleted Order');
    }
    public function orderCancle($value)
    {
        $order = Order::findOrFail($value);

        if ($order->user_id !== auth()->user()->id) {
            abort(403);
        }
        if($order->status == 0){
            $order->status = 1;
        }else{
            $order->status = 0;
        }
        $order->save();
        return redirect()->back();
    }
}
