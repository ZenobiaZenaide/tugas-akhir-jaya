<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

//App Models
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Orders;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\Coupon;
use App\Models\Slides;

class AdminController extends Controller
{
    public function index()
{
    $orders = Orders::orderBy('created_at', 'DESC')->take(5)->get();

    // Corrected query for dashboardDatas
    $dashboardDatas = DB::select("
        SELECT SUM(subtotal) AS TotalSubtotalAmount,
               SUM(CASE WHEN status = 'ordered' THEN subtotal ELSE 0 END) AS TotalOrderedAmount,
               SUM(CASE WHEN status = 'delivered' THEN subtotal ELSE 0 END) AS TotalDeliveredAmount,
               SUM(CASE WHEN status = 'canceled' THEN subtotal ELSE 0 END) AS TotalCanceledAmount,
               COUNT(*) AS Total,
               SUM(CASE WHEN status = 'ordered' THEN 1 ELSE 0 END) AS TotalOrdered,
               SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) AS TotalDelivered,
               SUM(CASE WHEN status = 'canceled' THEN 1 ELSE 0 END) AS TotalCanceled
        FROM Orders
    ");

    // Corrected query for monthly data
    $monthlyDatas = DB::select("
        SELECT 
            EXTRACT(MONTH FROM created_at) AS MonthNo,
            TO_CHAR(created_at, 'Mon') AS MonthName,
            SUM(subtotal) AS TotalAmount,
            SUM(CASE WHEN status = 'ordered' THEN subtotal ELSE 0 END) AS TotalOrderedAmount,
            SUM(CASE WHEN status = 'delivered' THEN subtotal ELSE 0 END) AS TotalDeliveredAmount,
            SUM(CASE WHEN status = 'canceled' THEN subtotal ELSE 0 END) AS TotalCanceledAmount
        FROM Orders
        WHERE EXTRACT(YEAR FROM created_at) = EXTRACT(YEAR FROM NOW())
        GROUP BY EXTRACT(MONTH FROM created_at), TO_CHAR(created_at, 'Mon')
        ORDER BY EXTRACT(MONTH FROM created_at)
    ");

    // Ensure monthly data is properly extracted
    $AmountM = implode(',', collect($monthlyDatas)->pluck('totalamount')->toArray());
    $orderedAmountM = implode(',', collect($monthlyDatas)->pluck('totalorderedamount')->toArray());
    $deliveredAmountM = implode(',', collect($monthlyDatas)->pluck('totaldeliveredamount')->toArray());
    $canceledAmountM = implode(',', collect($monthlyDatas)->pluck('totalcanceledamount')->toArray());

    // Sum up the values to get total amounts
    $TotalAmount = collect($monthlyDatas)->sum('totalamount');
    $TotalOrderAmount = collect($monthlyDatas)->sum('totalorderedamount');
    $TotalDeliveredAmount = collect($monthlyDatas)->sum('totaldeliveredamount');
    $TotalCanceledAmount = collect($monthlyDatas)->sum('totalcanceledamount');

        
    return view('admin.index',compact(
        'orders', 'dashboardDatas', 'AmountM', 'orderedAmountM', 'deliveredAmountM', 'canceledAmountM',
        'TotalAmount', 'TotalOrderAmount', 'TotalDeliveredAmount', 'TotalCanceledAmount'
    ));


    }

    public function brands(){
        $brands = Brand::orderBy('brand_id','DESC')->paginate(5); // Changed from 'id'
        return view('admin.brands', compact('brands'));
    }

    public function add_brand(){
        return view('admin.brands-add');
    }

    //BRANDS

    public function brand_store(request $request){
        $request->validate([
            'brand_id' => 'required|unique:brands,brand_id',
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $brand = new Brand();
        $brand->brand_id = $request->brand_id; 
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $file_name = Str::slug($request->name).'.'.$image->getClientOriginalExtension();
            $this->GenerateBrandThumbnailsImage($image, $file_name);
            $brand->image = $file_name;
        }
        $brand->save();
        return redirect()->route('admin.brands')->with('status','Brand has been added succesfully!');
    }

    public function brand_edit($brand_id){ 
        $brand = Brand::find($brand_id); 
        return view('admin.brands-edit', compact('brand'));
    }

    public function brand_update(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$request->brand_id.',brand_id', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $brand = Brand::find($request->brand_id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        if($request->hasFile('image')){
            if(File::exists(public_path('uploads/brands').'/'.$brand->image)){
                File::delete(public_path('uploads/brands').'/'.$brand->image);
            }
            $image = $request->file('image');
            $file_name = Str::slug($request->name).'.'.$image->getClientOriginalExtension();
            $this->GenerateBrandThumbnailsImage($image, $file_name);
            $brand->image = $file_name;
        }
        $brand->save();
        return redirect()->route('admin.brands')->with('status','Brand has been updated succesfully!');
    }

    public function brand_delete($brand_id){ 
        $brand = Brand::find($brand_id); 
        if(File::exists(public_path('uploads/brands').'/'.$brand->image)){
            File::delete(public_path('uploads/brands').'/'.$brand->image);
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('status','Brand has been deleted succesfully!');
    }

    public function GenerateBrandThumbnailsImage($image, $imageName){
        $destinationPath = public_path('uploads/brands');
        $img = Image::read($image->path());
        $img->cover(124,124,'top');
        $img->resize(124,124,function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
    }

    // CATEGORIES

    public function categories()
    {
        $categories = Category::orderBy("category_id","DESC")->paginate(10); 
        return view('admin.categories', ['categories' => $categories]);
    }

    public function category_add(){
        return view('admin.category-add');
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|unique:categories,category_id',
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
        ]);

        $category = new Category();
        $category->category_id = $request->category_id; 
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $file_extention = $image->extension(); 
            $file_name = Carbon::now()->timestamp.'.'.$file_extention;
            $this->GenerateCategoryThumbnailsImage($image, $file_name);
            $category->image = $file_name;
        } else {
            $category->image = null; 
        }
        $category->save();

        return redirect()->route('admin.categories')->with('status','Category has been added succesfully');
    }

    public function GenerateCategoryThumbnailsImage($image, $imageName){
        $destinationPath = public_path('uploads/categories');
        $img = Image::read($image->path());
        $img->cover(124,124,"top");
        $img->resize(124,124,function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
    }

    public function category_delete($id){
        $category = Category::find($id);
        if(File::exists(public_path('uploads/categories').'/'.$category->image)){
            File::delete(public_path('uploads/categories').'/'.$category->image);
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('status','Category has been deleted succesfully');
    }

    public function category_edit($id){
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }

    public function category_update(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $request->id . ',category_id', 
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);


        $category = Category::find($request->id);
        $category->name = $request->name;

        if ($category->slug !== Str::slug($request->name)) {
            $category->slug = Str::slug($request->name);
        }

        if($request->hasFile('image')){
            if(File::exists(public_path('uploads/categories'.'/'.$category->image))){
                File::delete(public_path('uploads/categories'.'/'.$category->image));
            }

            $image = $request->file('image');
            $file_extention = $image->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extention;
            $this->GenerateCategoryThumbnailsImage($image, $file_name);
            $category->image = $file_name;
        }
        $category->save();
        return redirect()->route('admin.categories')->with('status','Category has been updated successfully');
    }

    //Products

    public function products(){
        $products = Product::orderBy('created_at','DESC')->paginate(4);
        return view('admin.products',compact('products'));
    }

    public function product_add(){
        $categories = Category::select('category_id','name')->orderBy('name')->get(); 
        $brands = Brand::select('brand_id','name')->orderBy('name')->get(); 
        return view('admin.product-add',compact('categories','brands'));
    }

    public function product_store(Request $request){
        $request->validate([
            'product_id' => 'required|unique:products,product_id',
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'regular_price' => 'required|numeric|max:999999.99',
            'sale_price' => 'required|numeric|max:999999.99',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required',
            'images.*' =>'nullable|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->regular_price > 9999999 || $request->sale_price > 9999999) {
            return back()->withInput()->withErrors([
                'regular_price' => 'The regular price or sale price cannot exceed 7 digits.',
            ]);
        }

        $product = new Product();
        $product->product_id = $request->product_id; 
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->image = $request->image;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $current_timestamp . '.' . $image->extension();
            $this->GenerateProductThumbnailsImage($image, $imageName);
            $product->image = $imageName;
        }

        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;

        if($request->hasFile('images')){
            $allowedfileExtion = ['jpg','png','jpeg'];
            $files = $request->file('images');
            foreach($files as $file){
                $gextension = $file->getClientOriginalExtension();
                $gcheck = in_array($gextension, $allowedfileExtion);
                if($gcheck){
                    $gfileName = $current_timestamp . "-" . $counter . "." .$gextension;
                    $this->GenerateProductThumbnailsImage($file, $gfileName);
                    array_push($gallery_arr, $gfileName);
                    $counter = $counter + 1;
                }
            }
        }
    
        $product->images = implode(',', $gallery_arr);
        $product->save();
        return redirect()->route('admin.products')->with('status','Product has been added succesfully');
    }

    public function GenerateProductThumbnailsImage($image, $imageName){
        $destinationPathThumbnail = public_path('uploads/products/thumbnails');
        $destinationPath = public_path('uploads/products');
        $img = Image::read($image->path());

        $img->cover(540,689,"top");
        $img->resize(540,689,function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath. '/' .$imageName);

        $img->resize(104,104,function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail. '/' .$imageName);
    }

    public function product_edit($product_id){ 
        $product = Product::find($product_id); 
        $categories = Category::select('category_id','name')->orderBy('name')->get();
        $brands = Brand::Select('brand_id','name')->orderBy('name')->get(); // Changed from 'id'
        return view('admin.product-edit', compact('product', 'categories', 'brands'));
    }

    public function product_update(Request $request){
        $request->validate([
            'name' => 'required|max:100',
            'slug' => 'required|unique:products,slug,' . $request->product_id . ',product_id', 
            'short_description' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'regular_price' => 'required|numeric|max:999999.99',
            'sale_price' => 'required|numeric|max:999999.99',
            'SKU' => 'required|max:20',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric|max:999999.99',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required',
            'images.*' =>'nullable|mimes:png,jpg,jpeg|max:2048'
        ]);

        $product = Product::find($request->product_id); 
        $product->name = $request->name;

        if ($product->slug !== Str::slug($request->name)) {
            $product->slug = Str::slug($request->name);
        }

        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp;

        if($request->hasFile('image')){
            
            foreach(explode(',',$product->images) as $ofile){
                if(File::exists(public_path('uploads/products').'/'.$product->image)){
                    File::delete(public_path('uploads/products').'/'.$product->image);
                }
                if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
                    File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
                }
            }
            
            $image = $request->file('image');
            $imageName = $current_timestamp . '.' . $image->extension();
            $this->GenerateProductThumbnailsImage($image, $imageName);
            $product->image = $imageName;

        }

        $gallery_arr = array();
        $gallery_images = "";
        $counter = 1;

        if($request->hasFile('images')){
            $allowedfileExtion = ['jpg','png','jpeg'];
            $files = $request->file('images');
            foreach($files as $file){
                $gextension = $file->getClientOriginalExtension();
                $gcheck = in_array($gextension, $allowedfileExtion);
                if($gcheck){
                    $gfileName = $current_timestamp . "-" . $counter . "." .$gextension;
                    $this->GenerateProductThumbnailsImage($file, $gfileName);
                    array_push($gallery_arr, $gfileName);
                    $counter = $counter + 1;
                }
            }
            $product->images = implode(',', $gallery_arr);
        }
    
        $product->save();
        return redirect()->route('admin.products')->with('status','Product has been updated succesfully');

    }

    public function product_delete($product_id){ 
        $product = Product::find($product_id); 
        if(File::exists(public_path('uploads/products').'/'.$product->image)){
            File::delete(public_path('uploads/products').'/'.$product->image);
        }
        if(File::exists(public_path('uploads/products/thumbnails').'/'.$product->image)){
            File::delete(public_path('uploads/products/thumbnails').'/'.$product->image);
        }
        $product->delete();
        return redirect()->route('admin.products')->with('status', 'Product Has Been Successfully Deleted.');
    }

    public function coupons(){
        $coupons = Coupon::orderBy('expiry_date','DESC')->paginate(5);
        return view('admin.coupons', compact('coupons'));
    }

    public function coupon_store(Request $request){
        $request->validate([
            'id' => 'required',
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required|date',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_id = $request->coupon_id; 
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        return redirect()->route('admin.coupons')->with('status','Coupon has been added successfully!');
    }

    public function coupon_add(){
        return view('admin.coupon-add');
    }

    public function coupon_edit($coupon_id){
        $coupon = Coupon::find($coupon_id); 
        return view('admin.coupon-edit', compact('coupon'));
    }

    public function coupon_update(Request $request){
        $request->validate([
            'code' => 'required',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required|date',
        ]);
    
        $coupon = Coupon::find($request->coupon_id); 
        if ($coupon->code !== $request->code && Coupon::where('code', $request->code)->exists()) {
            return redirect()->back()->withErrors(['code' => 'The coupon code already exists. Please choose another one.']);
        }
    
        $coupon->type = $request->type; 
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
    
        $coupon->save();
    
        return redirect()->route('admin.coupons')->with('status', 'Coupon has been updated successfully!');
    }
    
    public function coupon_delete($coupon_id){ 
        $coupon = Coupon::find($coupon_id); 
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('status','Coupon has been deleted Successfully');
    }


    public function orders(){
        $orders = Orders::orderBy('created_at','DESC')->paginate(5);
        return view('admin.orders', compact('orders'));
    }

    public function order_details($orders_id){
        $order = Orders::find($orders_id);
        $orderitems = OrderItem::where('order_id', $orders_id)->orderBy('id')->paginate(5); 
        $transaction = Transaction::where('order_id', $orders_id)->first(); 
        return view('admin.order-details', compact('order', 'orderitems', 'transaction'));
    }

    public function update_order_status(Request $request){

        $order = Orders::find($request->orders_id);
        $order->status = $request->order_status;
        if($request->order_status == 'delivered'){
            $order->delivered_date = Carbon::now();
        }
        elseif($request->order_status == 'canceled'){
            $order->canceled_date = Carbon::now();
        }
        $order->save();

        if($request->order_status == 'delivered'){
            $transaction = Transaction::where('order_id', $request->orders_id)->first(); 
            $transaction->status = 'approved';
            $transaction->save();
        }
        return back()->with('status', 'Status changed successfully!');
    }

    //SLIDES

    public function slides(){
        $slides = Slides::orderBy('slide_id', 'DESC')->paginate(5); 
        return view('admin.slides', compact('slides'));
    }
    
    public function slide_add(){
        return view('admin.slide-add');
    }

    public function slide_store(Request $request){
        $request->validate([
            'slide_id' => 'required|unique:slides,slide_id',
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
        ]);
        $slide = new Slides();
        $slide->slide_id = $request->slide_id; 
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenerateSlideThumbnailsImage($image, $file_name);
        $slide->image = $file_name;
        $slide->save();
        return redirect()->route('admin.slides')->with('status', 'Slide added succesfully!');
    }

    public function GenerateSlideThumbnailsImage($image, $imageName){
        $destinationPath = public_path('uploads/slides');
        $img = Image::read($image->path());
        $img->cover(400,690,"top");
        $img->resize(400,690,function($constraint){
            $constraint->aspectration();
        })->save($destinationPath.'/'.$imageName);
    }

    public function slide_edit($slide_id){ 
        $slide = Slides::find($slide_id); 
        return view('admin.slide-edit',compact('slide'));
    }

    public function slide_update(Request $request){
        $request->validate([
        
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'status' => 'required|boolean',
        ]);
        $slide = Slides::find($request->slide_id); 
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if($request->hasFile('image')){
            if(File::exists(public_path('upload/slides').'/'.$slide->image)){
                File::delete(public_path('uploads/slides').'/'. $slide->image);
            }
            $image = $request->file('image');
            $file_extension = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extension;
            $this->GenerateSlideThumbnailsImage($image, $file_name);
            $slide->image = $file_name;
        }

        $slide->save();
        return redirect()->route('admin.slides')->with('status', 'Slide added succesfully!');
    }

    public function slide_delete($slide_id){ 
        $slide = Slides::find($slide_id); 
        if(File::exists(public_path('uploads/slides').'/'.$slide->image)){
            File::delete(public_path('uploads/slides').'/'.$slide->image);
        }
        $slide->delete();
        return redirect()->route('admin.slides')->with('status','Slide deleetd successfully.');
    }




}


