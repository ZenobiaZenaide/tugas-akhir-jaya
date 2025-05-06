<?php

//Controller List
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishListController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authadmin;

Auth::routes();

Route::get('/', [HomeController::class,'index'])->name('home.index');


//Shop

Route::get('/shop', [ShopController::class,'index'])->name('shop.index');
Route::get('/shop/{product_slug}', [ShopController::class,'product_details'])->name('shop.product-details');

//Shopping Cart
Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/add',[CartController::class,'add_to_cart'])->name('cart.add');
Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.qty-increase');
Route::put('/cart/decrease-quantity/{rowId}',[CartController::class, 'decrease_cart_quantity'])->name('cart.qty-decrease');
Route::delete('/cart/remove-item/{rowId}',[CartController::class, 'remove_item'])->name('cart.remove-item');
Route::delete('/cart/clear',[CartController::class,'empty_cart'])->name('cart.empty-item');

//Wishlist
Route::post('/wishlist/add-to-wishlist', [WishListController::class,'add_to_wishlist'])->name('wishlist.add-item');
Route::get('/wishlist', [WishListController::class, 'index'])->name('wishlist.index');
Route::delete('/wishlist/item/remove/{rowId}', [WishlistController::class, 'remove_item'])->name('wishlist.item-remove');
Route::delete('/wishlist/clear', [WishlistController::class, 'empty_wishlist'])->name('wishlist.items-clear');
Route::post('/wishlist/move-to-cart/{rowId}',[WishlistController::class, 'move_to_cart'])->name('wishlist.move-to-cart');


//Checkout
Route::get('/checkout',[CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/place-an-order',[CartController::class, 'place_an_order'])->name('cart.place-an-order');
Route::get('/order-confirmation', [CartController::class,'order_confirmation'])->name('cart.order-confirmation');


//Admin Route
Route::middleware(['auth',AuthAdmin::class])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});


//User Route
Route::middleware(['auth'])->group(function(){
    //Brands
    Route::get('/account-dashboard', [UserController::class,'index'])->name('user.index');
    Route::get('/admin/brands', [AdminController::class, 'brands'])->name('admin.brands');
    Route::get('/admin/brand/add', [AdminController::class, 'add_brand'])->name('admin.brands-add');
    Route::post('admin/brand/store', [AdminController::class, 'brand_store'])->name('admin.brands-store');
    Route::get('/admin/brand/edit/{brand_id}', [AdminController::class, 'brand_edit'])->name('admin.brands-edit'); // Changed {id} to {brand_id}
    Route::put('admin/brand/update', [AdminController::class, 'brand_update'])->name('admin.brands-update'); // Ensure the form sends brand_id
    Route::delete('admin/brand/{brand_id}/delete', [AdminController::class, 'brand_delete'])->name('admin.brands-delete'); // Changed {id} to {brand_id}

    //Categories
    Route::get('/admin/categories',[AdminController::class,'categories'])->name('admin.categories');
    Route::get('/admin/category/add',[AdminController::class,'category_add'])->name('admin.category-add');
    Route::post('/admin/category/store',[AdminController::class,'category_store'])->name('admin.category-store');
    Route::delete('admin/category/{category_id}/delete',[AdminController::class,'category_delete'])->name('admin.category-delete'); // Changed {id} to {category_id}
    Route::get('/admin/category/edit/{category_id}', [AdminController::class, 'category_edit'])->name('admin.category-edit'); // Changed {id} to {category_id}
    Route::put('/admin/category/update',[AdminController::class, 'category_update'])->name('admin.category-update');

    //Products
    Route::get('/admin/products',[AdminController::class,'products'])->name('admin.products');
    Route::get('/admin/product/add', [AdminController::class,'product_add'])->name('admin.product-add');
    Route::post('/admin/product/store',[AdminController::class, 'product_store'])->name('admin.product-store');
    Route::get('/admin/product/{product_id}/edit', [AdminController::class, 'product_edit'])->name('admin.product-edit'); // Changed {id} to {product_id}
    Route::put('/admin/product/update', [AdminController::class, 'product_update'])->name('admin.product-update');
    Route::delete('/admin/product/{product_id}/delete',[AdminController::class,'product_delete'])->name('admin.product-delete'); // Changed {id} to {product_id}

    //Coupon
    Route::get('/admin/coupons',[AdminController::class, 'coupons'])->name('admin.coupons');
    Route::get('/admin/coupons/add',[AdminController::class, 'coupon_add'])->name('admin.coupons-add');
    Route::post('/admin/coupon/store', [AdminController::class, 'coupon_store'])->name('admin.coupon-store');
    Route::get('/admin/coupon/edit/{coupon_id}', [AdminController::class, 'coupon_edit'])->name('admin.coupon-edit');
    Route::delete('/admin/coupon/{coupon_id}/delete', [AdminController::class, 'coupon_delete'])->name('admin.coupon-delete');
    Route::put('/admin/coupon/update', [AdminController::class, 'coupon_update'])->name('admin.coupon-update');
    // Route::delete('/admin/coupon/{id}/delete', [AdminController::class, 'coupon_delete'])->name('admin.coupon-delete'); // Remove this duplicate line
    Route::post('/cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name('cart.coupon-apply');
    Route::delete('/cart/remove-coupon', [CartController::class, 'remove_coupon_code'])->name('cart.coupon-remove');
    //Order
    Route::get('/admin/orders',[AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/admin/order/{order_id}/details',[AdminController::class,'order_details'])->name('admin.order-details');
    Route::put('/admin/order/update-status', [AdminController::class, 'update_order_status'])->name('admin.order-update-status');


    //Order User
    Route::get('/account-orders',[UserController::class,'orders'])->name('user.orders');
    Route::get('/account-order/{order_id}/details', [UserController::class,'order_details'])->name('user.order-details');
    Route::put('/account-order/cancel-order', [UserController::class, 'order_cancel'])->name('user.order-cancel');

    Route::get('/admin/slides',[AdminController::class,'slides'])->name('admin.slides');
    Route::get('/admin/slide/add', [AdminController::class,'slide_add'])->name('admin.slide-add');
    Route::post('/admin/slide/store', [AdminController::class, 'slide_store'])->name('admin.slide-store');
    Route::get('/admin/slide/{slide_id}/edit', [AdminController::class, 'slide_edit'])->name('admin.slide-edit'); // Changed {id} to {slide_id}
    Route::put('/admin/slide/update', [AdminController::class, 'slide_update'])->name('admin.slide-update');
    Route::delete('/admin/slide/{slide_id}/delete', [AdminController::class, 'slide_delete'])->name('admin.slide-delete'); // Changed {id} to {slide_id}
});


