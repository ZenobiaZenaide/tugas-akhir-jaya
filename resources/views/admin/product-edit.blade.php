@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">

                <h3>Edit Product</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Add product</div>
                    </li>
                </ul>
            </div>
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.product-update')}}">
                @csrf
                @method('PUT')
                <div class="wg-box">
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}"/> 
                    <fieldset class="name">
                        <div class="body-title mb-10">Product ID<span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product ID" name="id" tabindex="0"
                            value="{{ $product->product_id }}" aria-required="true" required="" disabled="true">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0"
                            value="{{ $product->name }}" aria-required="true" required="">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                            @error('name')
                            <span class="alert alert-danger text-center"> {{ $message }}
                            @enderror
                    </fieldset>

                        <fieldset class="slug">
                            <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter product slug" name="slug"
                                tabindex="0" value="{{ $product->slug }}" aria-required="true" required="">
                            <div class="text-tiny">Do not exceed 100 characters when entering the
                                product name.</div>
                        </fieldset>

                        @error('slug')
                            <span class="alert alert-danger text-center"> {{ $message }}
                            @enderror

                            <div class="gap22 cols">
                                <fieldset class="category">
                                    <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
                                    </div>
                                    <div class="select">
                                        <select class="" name="category_id">
                                            <option value="" selected disabled>Choose category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}" {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </fieldset>

                                @error('category_id')
                                    <span class="alert alert-danger text-center"> {{ $message }}
                                    @enderror


                                    <fieldset class="brand">
                                        <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                                        </div>
                                        <div class="select">
                                            <select class="" name="brand_id">
                                                <option value="" selected disabled>Choose Brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->brand_id }}" {{ $product->brand_id == $brand->brand_id ? 'selected' : '' }}> {{-- Changed $brand->id to $brand->brand_id (twice) --}}
                                                        {{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </fieldset>

                                    @error('brand_id')
                                        <span class="alert alert-danger text-center"> {{ $message }}
                                    @enderror

                            </div>

                            <fieldset class="shortdescription">
                                <div class="body-title mb-10">Short Description <span class="tf-color-1">*</span></div>
                                <textarea class="mb-10 ht-150" name="short_description" placeholder="Short Description" tabindex="0"
                                    aria-required="true" required="">{{ $product->short_description }} </textarea>
                                <div class="text-tiny">Maksimal kata adalah 250 kata.</div>

                            @error('short_description')
                            <span class="alert alert-danger text-center"> {{ $message }}
                            @enderror

                            </fieldset>

                                <fieldset class="description">
                                    <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                                    </div>
                                    <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true"
                                        required="">{{ $product->description }}</textarea>
                                    <div class="text-tiny">Maksimal kata adalah 1000 kata.</div>
                                </fieldset>

                                @error('description')
                                    <span class="alert alert-danger text-center"> {{ $message }}
                                @enderror

                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Upload image <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if($product->image)
                            <div class="item" id="imgpreview">
                                <img src="{{ asset('uploads/products')}}/{{$product->image}}" class="effect8"
                                    alt="">
                            </div>
                            @endif
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                            browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    @error('image')
                        <span class="alert alert-danger text-center"> {{ $message }}
                        @enderror
                        <fieldset>
                            <div class="body-title mb-10">Upload Gallery Images</div>
                            <div class="upload-image flex-grow">
                                @if($product->images)
                                    <div id="gallery-images-container">
                                        @foreach(explode(',', $product->images) as $img)
                                            <div class="item gitem">
                                                <img src="{{ asset('uploads/products') }}/{{ trim($img) }}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                        
                                <div id="galUpload" class="item up-load">
                                    <label class="uploadfile" for="gFile">
                                        <span class="icon">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="text-tiny">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                        <input type="file" id="gFile" name="images[]" accept="image/*" multiple="">
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        
                        @error('images')
                            <span class="alert alert-danger text-center"> {{ $message }}</span>
                        @enderror
                        

                            <div class="cols gap22">
                                <fieldset class="name">
                                    <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                                    <input class="mb-10" type="text" placeholder="Enter regular price"
                                        name="regular_price" tabindex="0" value="{{ $product->regular_price }}"
                                        aria-required="true" required="">
                                        @error('regular_price')
                                        <span class="alert alert-danger text-center"> {{ $message }}
                                        @enderror
                                </fieldset>



                                <fieldset class="name">
                                    <div class="body-title mb-10">Sale Price <span class="tf-color-1">*</span></div>
                                    <input class="mb-10" type="text" placeholder="Enter sale price"
                                        name="sale_price" tabindex="0" value="{{ $product->sale_price }}"
                                        aria-required="true" required="">

                                @error('sale_price')
                                <span class="alert alert-danger text-center"> {{ $message }}
                                @enderror

                                </fieldset>
                            </div>

                            <div class="cols gap22">
                                <fieldset class="name">
                                    <div class="body-title mb-10">SKU <span class="tf-color-1"></span>
                                    </div>
                                    <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU"
                                        tabindex="0" value="{{ $product->SKU }}" aria-required="true" required="">
                                        @error('SKU')
                                        <span class="alert alert-danger text-center"> {{ $message }}
                                        @enderror
                                </fieldset>


                                <fieldset class="name">
                                    <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                                    </div>
                                    <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity"
                                        tabindex="0" value="{{ $product->quantity }}" aria-required="true"
                                        required="">
                                        @error('quantity')
                                        <span class="alert alert-danger text-center"> {{ $message }}
                                        @enderror
                                </fieldset>
                                    

                            </div>

                            <div class="cols gap22">
                                <fieldset class="name">
                                    <div class="body-title mb-10">Stock</div>
                                    <div class="select mb-10">
                                        <select class="" name="stock_status">
                                            <option value="instock" {{ $product->stock_status == "instock" ? "selected" : ""}}>InStock</option>
                                            <option value="outofstock" {{ $product->stock_status == "outofstock" ? "selected" : "" }}>Out of Stock</option>
                                        </select>
                                    </div>
                                </fieldset>

                                <fieldset class="name">
                                    <div class="body-title mb-10">Featured</div>
                                    <div class="select mb-10">
                                        <select class="" name="featured">
                                            <option value="0" {{ $product->featured == "0" ? "selected" : ""}}>No</option>
                                            <option value="1" {{ $product->featured == "1" ? "selected" : ""}}>Yes</option>
                                        </select>
                                    </div>
                                </fieldset>

                            </div>
                            <div class="cols gap10">
                                <button class="tf-button w-full" type="submit">Save product</button>
                            </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
<script>
$(function(){
    $('#myFile').on("change", function(e){
        const [file] = this.files;  

        if(file){

            $("#imgpreview img").attr('src', URL.createObjectURL(file));
            $("#imgpreview").show(); 
        } else {
            $("#imgpreview").hide();  
        }
    });

    $('#gFile').on("change", function(e){
        const gphotos = this.files;  
        $("#gallery-images-container").empty(); 
        $.each(gphotos, function(key, val){
            $("#gallery-images-container").prepend(`
                <div class="item gitem">
                    <img src="${URL.createObjectURL(val)}" />
                </div>
            `);
        });
    });


    $('#removeAllGalleryPhotos').on("click", function(){
        $("#gallery-images-container").empty();

        $('#gFile').val(null);
    });

    $("input[name='name']").on("change", function(){
        $("input[name='slug']").val(StringToSlug($(this).val()));
    });

    $(document).on('click', '.remove-icon', function(){
        $('#myFile').val(null);
        $("#imgpreview").hide();
    });
});


function StringToSlug(Text){
    return Text.toLowerCase()
    .replace(/[^\w ]+/g, "") 
    .replace(/ +/g, "-");  
}
</script>
@endpush
