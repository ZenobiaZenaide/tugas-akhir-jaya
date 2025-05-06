<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\Address;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Transaction;

use App\Models\Coupon;

class CartController extends Controller
{
    public function index(){
        $items = Cart::instance('cart')->content();
        return view('cart',compact('items'));
    }

    
    public function add_to_cart(Request $request){
        Cart::instance('cart')->add(
            $request->id,
            $request->name,
            $request->quantity,
            $request->price)->associate('App\Models\Product');
            return redirect()->back();
    }

    public function increase_cart_quantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        return redirect()->back();
    }

    public function decrease_cart_quantity($rowId){
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        return redirect()->back();
    }

    public function remove_item($rowId){
        Cart::instance("cart")->remove($rowId);
        return redirect()->back();
    }

    public function empty_cart(){
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function apply_coupon_code(Request $request)
    {

       
        $coupon_code = $request->coupon_code;
    
        if (isset($coupon_code)) {
            // Get cart subtotal and clean it
            $rawSubtotal = Cart::instance('cart')->subtotal(); // e.g., "8,000.00"
            $cleanSubtotal = floatval(str_replace(',', '', $rawSubtotal)); // 8000.00
    
            // Find valid coupon
            $coupon = Coupon::where('code', $coupon_code)
                ->where('expiry_date', '>=', Carbon::today())
                ->where('cart_value', '<=', $cleanSubtotal)
                ->first();
    
            if (!$coupon) {
                return redirect()->back()->with('error', 'Invalid coupon code!');
            } else {
                Session::put('coupon', [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'cart_value' => $coupon->cart_value,
                ]);
                $this->calculateDiscount();
                return redirect()->back()->with('success', 'Coupon has been applied');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid coupon code!');
        }
    }
    

    public function calculateDiscount()
    {
        $discount = 0;
    
        // Clean and convert subtotal to float
        $rawSubtotal = Cart::instance('cart')->subtotal(); // e.g., "8,000.00"
        $subtotal = floatval(str_replace(',', '', $rawSubtotal)); // 8000.00
    
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
    
            if ($coupon['type'] == 'fixed') {
                $discount = floatval($coupon['value']);
            } else {
                $discount = ($subtotal * floatval($coupon['value'])) / 100;
            }
    
            $subtotalAfterDiscount = $subtotal - $discount;
            $totalAfterDiscount = $subtotalAfterDiscount;
    
            Session::put('discounts', [
                'discount' => number_format($discount, 2, '.', ''),
                'subtotal' => number_format($subtotalAfterDiscount, 2, '.', ''),
                'total' => number_format($totalAfterDiscount, 2, '.', ''),
            ]);
        }
    }
    
    public function remove_coupon_code(){
        Session::forget('coupon');
        Session::forget('discounts');
        return back()->with('success', 'Coupon has been removed');
    }

    public function checkout(){
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $address = Address::where('user_id', Auth::user()->id)->where('isdefault',1)->first();
        return view('checkout', compact('address'));
    }

    public function order_confirmation(){
        if(Session::has('orders_id')){
            $order = Orders::with('orderitems')->find(Session::get('orders_id'));
            
            // dd($order);
            return view('order-confirmation', compact('order'));
        }
        return redirect()->route('cart.index');
    }

    public function place_an_order(Request $request){
        // dd(Auth::user()->user_id);
        $user_id = Auth::user()->user_id;
        $address = Address::where('user_id', $user_id)->where('isdefault', true)->first();

        if(!$address){
            $request->validate([
                'name' => 'required|max:100',
                'phone' => 'required|numeric|digits:12',
                'zip' => 'required|numeric|digits:6',
                'state' => 'required',
                'city' =>'required',
                'address' => 'required',
                'locality' => 'required',
                'landmark' => 'required',
            ]);

            
            $address = new Address();
            $address->user_id = $user_id;
            $address->name = $request->name;
            $address->phone = $request->phone;
            $address->zip = $request->zip;
            $address->state =$request->state;
            $address->city =$request->city;
            $address->address =$request->address;
            $address->locality =$request->locality;
            $address->landmark =$request->landmark;
            $address->country = 'Indonesia';
            $address->isdefault = true;
            $address->save();
        }

        $this->setAmountforCheckout();

        $subtotal = str_replace(',', '', Session::get('checkout')['subtotal']);  
        $discount = str_replace(',', '', Session::get('checkout')['discount']);  

        $order = new Orders();
        $order->user_id = $user_id;
        $order->subtotal = (float) $subtotal;  // Ensure numeric format
        $order->discount = (float) $discount; 
        $order->name = $address->name;
        $order->phone = $address->phone;
        $order->locality = $address->locality;
        $order->address = $address->address;
        $order->city = $address->city;
        $order->state = $address->state;
        $order->country = $address->country;
        $order->landmark = $address->landmark;
        $order->zip = $address->zip;
        $order->save();


        // dd(Cart::instance('cart'));
        foreach(Cart::instance('cart')->content() as $item){
            // dd($item);
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id; // Changed from orders_id to order_id
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            // dd($orderItem);
            $orderItem->save();  
        }

        if($request->mode == "card"){

        }
        elseif($request->mode == "cod"){
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id; // Changed from orders_id to order_id
            $transaction->mode = $request->mode;
            $transaction->status = "pending";
            $transaction->save();
        }

        Cart::instance('cart')->destroy();
        Session::forget('checkout');
        Session::forget('coupon');
        Session::forget('discounts');
        Session::put('orders_id', $order->id);
        return redirect()->route('cart.order-confirmation');
    }

    public function setAmountforCheckout(){
        // dd(Session::all());
        if(Cart::instance('cart')->content()->count() > 0){
            Session::forget('checkout');
        }

        if(Session::has('coupon')){
            Session::put('checkout', [
                'discount' => Session::get('discounts')['discount'],
                'subtotal' =>  Session::get('discounts')['subtotal'],
            ]);
        }
        else{
            Session::put('checkout',[
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
            ]);
        }

    }
}
