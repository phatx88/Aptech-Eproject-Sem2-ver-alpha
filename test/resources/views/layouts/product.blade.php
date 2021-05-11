<div class="product ftco-animate items-products">
    <form>
        @csrf
        <input type="hidden" id="product_name_cart_{{ $product->id }}" class="product_name_cart_{{ $product->id }}"
            value="{{ $product->name }}">
        @if ($product->price != $product->sale_price)
            <input type="hidden" id="product_price_cart_{{ $product->id }}" class="product_price_cart_{{ $product->id }}"
                value="{{ $product->sale_price }}">
        @else
            <input type="hidden" id="product_price_cart_{{ $product->id }}" class="product_price_cart_{{ $product->id }}"
                value="{{ $product->price }}">
        @endif
        <input type="hidden" id="product_quantity_cart_{{ $product->id }}" class="product_quantity_cart_{{ $product->id }}" value="1">
        <input type="hidden" id="product_image_cart_{{ $product->id }}" class="product_image_cart_{{ $product->id }}"
            value="{{ $product->featured_image }}">
        <input type="hidden" id="product_category_cart_{{ $product->id }}" value="{{ $product->category_name }}">
        <div class="img d-flex align-items-center justify-content-center image-products_{{ $product->id }}"
            style="background-image: url('{{ asset('frontend/images/products/' . $product->featured_image) }}');">

            <img id="img_{{ $product->id }}" class="img_{{ $product->id }}" src="{{  asset('frontend/images/products/' . $product->featured_image)  }}" height="40px" width="40px" style="visibility: hidden; position: absolute;" alt="">

            <div class="desc">
                <p class="meta-prod d-flex">
                    @if ($product->inventory_qty == 0)
                        <a type="button" style="cursor: pointer;"
                            data-id_product="{{ $product->id }}"
                            class="d-flex align-items-center justify-content-center"
                            onclick="notyf.error('Currently Out of Stock');"><span
                                class="flaticon-shopping-bag"></span></a>
                    @else
                        <a type="button" style="cursor: pointer;"
                            data-id_product="{{ $product->id }}"
                            class="d-flex align-items-center justify-content-center add-to-cart"><span
                                class="flaticon-shopping-bag"></span></a>
                    @endif
                    @if(Auth::check())
                    <input type="hidden" class="user_id_wishlist_{{ $product->id }}"
                    value="{{ Auth::user()->id }}">
                        <a type="button" style="cursor: pointer;"
                        data-id_product="{{ $product->id }}"
                        class="d-flex align-items-center justify-content-center add-to-wishlist"
                        ><span
                            class="flaticon-heart
                            "></span></a>

                    @else
                    <a type="button"
                        class="d-flex align-items-center justify-content-center" style="cursor: pointer;" onclick="notyf.error('You must login before adding to wishlist');"><span
                            class="flaticon-heart
                            "></span></a>
                    @endif
                    <a id="product_detail_{{ $product->id }}" href="{{ url('home/single-product/' . $product->id) }}"
                        class="d-flex align-items-center justify-content-center"><span
                            class="flaticon-visibility"></span></a>
                    <a style="cursor: pointer;" class="d-flex align-items-center justify-content-center" onclick="add_compare({{ $product->id }})" data-toggle="modal" data-target="#compare"><span
                        class="fa fa-compress" ></span></a>
                </p>
            </div>
            {{-- data-toggle="modal" data-target="#compare" --}}
        </div>

        <div class="text text-center">

            @if (strtotime($product->created_date) >= strtotime('-30 days'))
                <span class="new">New Arrival</span>
            @endif
            @if (in_array($product->name , $bestSelling))
            <span class="seller">Best Seller</span>
            @endif
            @if ($product->featured)
                <span class="sale">Featured</span>
            @endif
            <span class="category">{{ $product->category_name }}</span>
            <h5>{{ $product->name }}</h5>
            <p class="mb-0">

                @if ($product->price != $product->sale_price)
                    <span class="price price-sale">${{ $product->price }}</span>
                @endif

            <span class="price">${{ $product->sale_price }}</span>
        </p>
        <p>Available:  {{ $product->inventory_qty }}</p>
    </div>
    </form>
</div>