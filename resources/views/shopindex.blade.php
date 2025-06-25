@extends('layouts.app')
@section('content')
<style>
    .brand-list li, .category-list li{
        line-height: 40px;
    }

    .brand-list li .chk-brand , .category-list li .chk-category{
        width: 1rem;
        height: 1rem;
        color: #e4e4e4;
        border: 0.125rem solid currentColor;
        border-radius: 0;
        margin-right: 0.75rem;
    }

    .filled-heart{
        color: orange;
    }
</style>
    <main class="pt-90">
        <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow" data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 1,
            "effect": "fade",
            "loop": true
          }'>
          <div class="swiper-wrapper">
            @foreach ($slides as $slide)
            <div class="swiper-slide">
              <div class="overflow-hidden position-relative h-100">
                <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                  <img loading="lazy" src="{{ asset('uploads/slides')}}/{{$slide->image}}" width="542" height="733"
                    alt="Woman Fashion 1"
                    class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
                  <div clas="character_markup type2">
                    <p
                      class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-0">
                      </p>
                  </div>
                </div>
                <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                  <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                    SELAMAT DATANG</h6>
                  <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">{{$slide->title}}</h2>
                  <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">{{$slide->subtitle}}</h2>
                </div>
              </div>
            </div>
            @endforeach
          </div>
</section>
 
                   
    
          <div class="container">
            <div class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5 swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet" tabindex="0">01</span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0">02</span></div>
          </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></section>
        <section class="shop-main container d-flex justify-content-center pt-4 pt-xl-5">


            <div class="shop-list justify-content-center flex-grow-1">
                <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
                    @foreach ($products as $product)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <div class="swiper-container background-img js-swiper-slider"
                                        data-settings='{"resizeObserver": true}'>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a
                                                    href="{{ route('shop.product-details', ['product_slug' => $product->slug]) }}"><img
                                              ©          loading="lazy"
                                                        src="{{ asset('uploads/products') }}/{{ $product->image }}"
                                                        width="330" height="400" alt="{{ $product->name }}"
                                                        class="pc__img"></a>
                                            </div>
                                            <div class="swiper-slide">

                                                @foreach (explode(',', $product->images) as $gimg)
                                                    <a
                                                        href="{{ route('shop.product-details', ['product_slug' => $product->slug]) }}"><img
                                                            loading="lazy"
                                                            src="{{ asset('uploads/products') }}/{{ $gimg }}"
                                                            width="330" height="400"
                                                            alt="Cropped Faux leather Jacket" class="pc__img"></a>
                                                @endforeach

                                            </div>
                                        </div>
                                        <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_prev_sm" />
                                            </svg></span>
                                        <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_next_sm" />
                                            </svg></span>
                                    </div>
                                    @if (Cart::instance('cart')->content()->where('id', $product->product_id)->count() > 0)
                                        <a href="{{ route('cart.index') }}"
                                            class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn btn-warning">Go
                                            to Cart</a>
                                    @else
                                        <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->product_id }}" /> 
                                            <input type="hidden" name="quantity" value="1" />
                                            <input type="hidden" name="name" value="{{ $product->name }}" />
                                            <input type="hidden" name="price"
                                                value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}" />
                                            <button
                                                class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart js-open-aside"
                                                data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                                        </form>
                                    @endif
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $product->category->name }}</p>
                                    <p>{{ $product->name }}</p>
                                    <h6 class="pc__title"><a
                                            href="{{ route('shop.product-details', ['product_slug' => $product->slug]) }}"></a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">
                                            @if ($product->sale_price)
                                                <s>Rp.{{ $product->regular_price }} </s> Rp.{{ $product->sale_price }}
                                            @else
                                                Rp.{{ $product->regular_price }}
                                            @endif
                                        </span>
                                    </div>


                                    @if (Cart::instance('wishlist')->content()->where('id', $product->product_id)->count() > 0) 
                                    <form method="POST" action="{{ route('wishlist.item-remove', ['rowId'=>Cart::instance('wishlist')->content()->where('id', $product->product_id)->first()->rowId])}}"> 
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist filled-heart"
                                            title="Add To Wishlist">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_heart" />
                                            </svg>
                                        </button>
                                    </form>
                                    @else
                                        <form method="POST" action="{{ route('wishlist.add-item') }}">
                                            @csrf
                                            <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->product_id }}" />
                                                <input type="hidden" name="quantity" value="1" />
                                                <input type="hidden" name="name" value="{{ $product->name }}" />
                                                <input type="hidden" name="price" value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}" />
                                                <button type="submit"
                                                    class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                                    title="Add To Wishlist">
                                                    <svg width="16" height="16" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_heart" />
                                                    </svg>
                                                </button>
                                            </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#orderby").on("change", function() {
                $("#order").val($("#orderby option:selected").val());
                $("#frmfilter").submit();
            })
        })
    </script>
@endpush
