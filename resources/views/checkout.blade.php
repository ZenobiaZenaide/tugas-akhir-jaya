@extends('layouts.app');
@section('content');
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Shipping and Checkout</h2>
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>KERANJANG KAMU</span>
                        <em>Barang yang ingin kamu beli</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Detail Shipping</span>
                        <em>Isi dan cek detail pengiriman</em>
                    </span>
                </a>
                <a href="avascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Konfirmasi</span>
                        <em>Review dan konfirmasi pesanan kamu</em>
                    </span>
                </a>
            </div>
            <form name="checkout-form" action="{{ route('cart.place-an-order')}}" method="POST">
                @csrf
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>SHIPPING DETAILS</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        @if ($address)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my-account__address-list">
                                        <div class="my-account__address-list-item">
                                            <div class="my-account__address-item__detail">
                                                <p>{{ $address->name }}</p>
                                                <p>{{ $address->address }}</p>
                                                <p>{{ $address->landmark }}</p>
                                                <p>{{ $address->city }}, {{ $address->state }}, {{ $address->state }}</p>
                                                <p>{{ $address->zip }}</p>
                                                <br />
                                                <p>{{ $address->phone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="name" required=""
                                            value="{{ old('name') }}">
                                        <label for="name">Full Name *</label>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="phone" required=""
                                            value="{{ old('phone') }}">
                                        <label for="phone">Phone Number *</label>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="zip" required=""
                                            value="{{ old('zip') }}">
                                        <label for="zip">Zip Code *</label>
                                        @error('zip')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating mt-3 mb-3">
                                        <input type="text" class="form-control" name="state" required=""
                                            value="{{ old('state') }}">
                                        <label for="state">State *</label>
                                        @error('state')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="city" required=""
                                            value="{{ old('city') }}">
                                        <label for="city">Town / City *</label>
                                        @error('city')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="address" required=""
                                            value="{{ old('address') }}">
                                        <label for="address">House no, Building Name *</label>
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="locality" required=""
                                            value="{{ old('locality') }}">
                                        <label for="locality">Road Name, Area, Colony *</label>
                                        @error('locality')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" name="landmark" required=""
                                            value="{{ old('landmark') }}">
                                        <label for="landmark">Landmark *</label>
                                        @error('landmark')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Pesanan Kamu</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th align="right">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::instance('cart')->content() as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->name }} x {{ $item->qty }}
                                                </td>
                                                <td align="right">
                                                    {{ $item->subtotal() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if (Session::has('discounts'))
                                    <table class="checkout-totals">
                                        <tbody>
                                            <tr>
                                                <th>Total cart</th>
                                                <td class="text-right">${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Discount - {{ Session::get('coupon')['code'] }}</th>
                                                <td class="text-right">${{ Session::get('discounts')['discount'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Price After Discount</th>
                                                <td class="text-right">${{ Session::get('discounts')['subtotal'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <table class="checkout-totals">
                                        <tbody>
                                            <tr>
                                                <th>TOTAL</th>
                                                <td class="text-right">${{ Cart::instance('cart')->subtotal() }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="checkout__payment-methods">
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode1" value="card" checked>
                                    <label class="form-check-label" for="mode1">
                                        Bank Transfer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode2" value="cod">
                                    <label class="form-check-label" for="mode2">
                                        Cash on Delivery
                                    </label>
                                </div>
                                <div class="policy-text">
                                    Semua data kamu yang telah kamu isi, dari akn hingga ke alamat bersifat konfidental dan tidak akan disebarluaskan.</a>.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-checkout">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
