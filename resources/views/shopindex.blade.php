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
        <section class="swiper-container  js-swiper-slider swiper-number-pagination slideshow swiper-container-fade swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events" data-settings="{
            &quot;autoplay&quot;: {
              &quot;delay&quot;: 5000
            },
            &quot;slidesPerView&quot;: 1,
            &quot;effect&quot;: &quot;fade&quot;,
            &quot;loop&quot;: true
          }">
          <div class="swiper-wrapper" id="swiper-wrapper-f093294a12b101367" aria-live="off" style="transition-duration: 0ms;"><div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="1" role="group" aria-label="1 / 4" style="width: 1512px; transition-duration: 0ms; opacity: 1; transform: translate3d(0px, 0px, 0px);">
              <div class="overflow-hidden position-relative h-100">
                <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                  <img loading="lazy" src="http://127.0.0.1:8000/uploads/slides/1741367095.png" width="542" height="733" alt="Woman Fashion 1" class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto">
                  <div clas="character_markup type2">
                    <p class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-0">
                      Tes</p>
                  </div>
                </div>
                <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                  <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                    New Arrivals</h6>
                  <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Tes</h2>
                  <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Tes</h2>
                  <a href="http://127.0.0.1:8000/shop" class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                    Now</a>
                </div>
              </div>
            </div>
                    <div class="swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="0" role="group" aria-label="2 / 4" style="width: 1512px; transition-duration: 0ms; opacity: 1; transform: translate3d(-1512px, 0px, 0px);">
              <div class="overflow-hidden position-relative h-100">
                <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                  <img loading="lazy" src="http://127.0.0.1:8000/uploads/slides/1741366437.png" width="542" height="733" alt="Woman Fashion 1" class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto">
                  <div clas="character_markup type2">
                    <p class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-0">
                      Tes</p>
                  </div>
                </div>
                <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                  <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                    New Arrivals</h6>
                  <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">ini judul</h2>
                  <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">ini subtitle</h2>
                  <a href="http://127.0.0.1:8000/shop" class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                    Now</a>
                </div>
              </div>
            </div>
                    <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="1" role="group" aria-label="3 / 4" style="width: 1512px; transition-duration: 0ms; opacity: 1; transform: translate3d(-3024px, 0px, 0px);">
              <div class="overflow-hidden position-relative h-100">
                <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                  <img loading="lazy" src="http://127.0.0.1:8000/uploads/slides/1741367095.png" width="542" height="733" alt="Woman Fashion 1" class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto">
                  <div clas="character_markup type2">
                    <p class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-0">
                      Tes</p>
                  </div>
                </div>
                <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                  <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                    New Arrivals</h6>
                  <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Tes</h2>
                  <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Tes</h2>
                  <a href="http://127.0.0.1:8000/shop" class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                    Now</a>
                </div>
              </div>
            </div>
                  <div class="swiper-slide swiper-slide-duplicate swiper-slide-next swiper-slide-duplicate-prev" data-swiper-slide-index="0" role="group" aria-label="4 / 4" style="width: 1512px; transition-duration: 0ms; opacity: 0; transform: translate3d(-4536px, 0px, 0px);">
              <div class="overflow-hidden position-relative h-100">
                <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                  <img loading="lazy" src="http://127.0.0.1:8000/uploads/slides/1741366437.png" width="542" height="733" alt="Woman Fashion 1" class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto">
                  <div clas="character_markup type2">
                    <p class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-0">
                      Tes</p>
                  </div>
                </div>
                <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                  <h6 class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                    New Arrivals</h6>
                  <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">ini judul</h2>
                  <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">ini subtitle</h2>
                  <a href="http://127.0.0.1:8000/shop" class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                    Now</a>
                </div>
              </div>
            </div></div>
    
          <div class="container">
            <div class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5 swiper-pagination-clickable swiper-pagination-bullets"><span class="swiper-pagination-bullet" tabindex="0">01</span><span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0">02</span></div>
          </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></section>
        <section class="shop-main container d-flex justify-content-center pt-4 pt-xl-5">


            <div class="shop-list justify-content-center flex-grow-1">

                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium"> </a>
                    </div>

                    <div
                        class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                        {{-- <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0"
                            aria-label="Sort Items" name="orderby" id="orderby">
                            <option value="-1" {{ $order == -1 ? 'selected' : '' }}>Default Sorting</option>
                            <option value="1" {{ $order == 1 ? 'selected' : '' }}>Date, New to Old</option>
                            <option value="2" {{ $order == 2 ? 'selected' : '' }}>Date, Old to New</option>
                            <option value="3" {{ $order == 3 ? 'selected' : '' }}>Price, low to high</option>
                            <option value="4" {{ $order == 4 ? 'selected' : '' }}>Price, high to low</option>

                        </select>

                        <div class="shop-asc__seprator mx-3 bg-light d-none d-md-block order-md-0"></div> --}}

                        <div class="col-size align-items-center order-1 d-none d-lg-flex">
                            <span class="text-uppercase fw-medium me-2">View</span>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="2">2</button>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="3">3</button>
                            <button class="btn-link fw-medium js-cols-size" data-target="products-grid"
                                data-cols="4">4</button>
                        </div>

                        <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                            <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside"
                                data-aside="shopFilter">
                                <svg class="d-inline-block align-middle me-2" width="14" height="10"
                                    viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_filter" />
                                </svg>
                                <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
                            </button>
                        </div>
                    </div>
                </div>

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
                                                        loading="lazy"
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
                                    @if (Cart::instance('cart')->content()->where('id', $product->product_id)->count() > 0) {{-- Changed $product->id --}}
                                        <a href="{{ route('cart.index') }}"
                                            class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn btn-warning">Go
                                            to Cart</a>
                                    @else
                                        <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->product_id }}" /> {{-- Changed $product->id --}}
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
                                    <h6 class="pc__title"><a
                                            href="{{ route('shop.product-details', ['product_slug' => $product->slug]) }}"></a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">
                                            @if ($product->sale_price)
                                                <s>${{ $product->regular_price }} </s> ${{ $product->sale_price }}
                                            @else
                                                ${{ $product->regular_price }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="product-card__review d-flex align-items-center">
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                        <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                                    </div>

                                    @if (Cart::instance('wishlist')->content()->where('id', $product->product_id)->count() > 0) {{-- Changed $product->id --}}
                                    <form method="POST" action="{{ route('wishlist.item-remove', ['rowId'=>Cart::instance('wishlist')->content()->where('id', $product->product_id)->first()->rowId])}}"> {{-- Changed $product->id --}}
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
                                                <input type="hidden" name="id" value="{{ $product->id }}" />
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

    <form id="frmfilter" method="GET">
        <input type="hidden" name="page" value="{{ $products->currentPage() }}">
        <input type="hidden" name="order" id="order" value="{{ $order }}" />
    </form>
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
