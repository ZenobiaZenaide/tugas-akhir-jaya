<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\Orders;
use App\Models\OrderItem;
use App\Models\Transaction;

use Carbon\Carbon;


class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function orders(){
        $orders = Orders::where('user_id', Auth::user()->user_id)->orderBy('created_at','DESC')->paginate(10);
        return view('user.orders', compact('orders'));
    }

    public function order_details($orders_id){
        $order = Orders::where('user_id', Auth::user()->user_id)->where('id', $orders_id)->first(); 
        if($order){
            $orderitems = OrderItem::where('order_id', $orders_id)->orderBy('id')->paginate(12); 
            $transaction = Transaction::where('order_id', $order->id)->first(); 
            return view('user.order-details', compact('order','orderitems','transaction'));
        }
        else{
            return redirect()->route('login');
        }
    }

    public function order_cancel(Request $request){
        $order = Orders::find($request->order_id);
        $order->status = "canceled";
        $order->canceled_date = Carbon::now();
        $order->save();
        return back()->with("status", "Order has Been Cancelled!");
    }
}


