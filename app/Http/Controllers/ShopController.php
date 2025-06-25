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
       
        $slides = Slides::where('status', 1)->take(3)->get();
        $products = Product::paginate(12); 

        return view('shopindex', compact('slides', 'products'));
    }

    public function product_details($product_slug){

        $product = Product::where('slug',$product_slug)->first();
        $rproducts = Product::where('slug','<>',$product_slug)->get()->take(8);
        return view('details',compact('product','rproducts'));
    }
}
