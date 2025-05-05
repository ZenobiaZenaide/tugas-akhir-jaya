<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


use App\Models\Product;
use App\Models\Slides;

class ShopController extends Controller
{
    public function index(request $request){
        $o_column = "";
        $o_order = "";
        $order = $request->query('order') ? $request->query('order') : -1;

        //Switch casenya filter di shopindex
        switch($order){
            case 1:
                $o_column='created_at';
                $o_order='DESC';
                break;
            case 2:
                $o_column='created_at';
                $o_order='ASC';
                break;
            case 3:
                $o_column='regular_price';
                $o_order='ASC';
                break;
            case 4:
                $o_column='regular_price';
                $o_order='DESC';
                break;
            default:
                $o_column = 'id';
                $o_order = 'DESC';
                
        }
        $slides = Slides::where('status',1)->get()->take(3);
        $products = Product::orderBy($o_column,$o_order)->paginate(12); 
        return view('shopindex', compact('slides','products','order'));
    }

    public function product_details($product_slug){

        $product = Product::where('slug',$product_slug)->first();
        $rproducts = Product::where('slug','<>',$product_slug)->get()->take(8);
        return view('details',compact('product','rproducts'));
    }
}
