<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index(){
       $orders = Order::with('user')->get();
       return view('admin.pages.Order.index',['model'=> $orders]);
    }
    public function items(OrderItem $model)
    {
        $items = OrderItem::where('order_id',$model->id)->get();
        
        return view('admin.pages.OrderItems.index', ['model' => $items]);
    }
}
