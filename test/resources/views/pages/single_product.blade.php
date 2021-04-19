@extends('main_layout')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('frontend/images/bg_2.jpg') }}');" <div
        class="overlay">
        </div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Products <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Products Single <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Products Single</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <form action="">
            @csrf
            @foreach ($product as $key => $val)
                <input type="hidden" class="product_name_cart_{{ $val->id }}" value="{{ $val->name }}">
                @if ($val->price != $val->sale_price)
                    <input type="hidden" class="product_price_cart_{{ $val->id }}" value="{{ $val->sale_price }}">
                @else
                    <input type="hidden" class="product_price_cart_{{ $val->id }}" value="{{ $val->price }}">
                @endif
                <input type="hidden" class="product_image_cart_{{ $val->id }}" value="{{ $val->featured_image }}">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 mb-5 ftco-animate">
                            <a href="{{ asset('frontend/images/products/' . $val->featured_image) }}"
                                class="image-popup prod-img-bg"><img
                                    src="{{ asset('frontend/images/products/' . $val->featured_image) }}"
                                    class="img-fluid" alt="Colorlib Template"></a>
                        </div>
                        <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                            <h3>{{ $val->name }}</h3>

                            <p class="price"><span>$
                                    @if ($val->price != $val->sale_price)
                                        {{ $val->sale_price }}
                                    @else
                                        {{ $val->price }}
                                    @endif
                                </span></p>
                            <p>
                                {{ $val->description }}
                            </p>
                            <div class="row mt-4">
                                <div class="input-group col-md-6 d-flex mb-3">
                                    <input type="number" id="quantity" name="quantity"
                                        class="quantity form-control input-number product_quantity_cart_{{ $val->id }}"
                                        value="1" min="1" max="100">
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <p style="color: #000;">{{ $val->inventory_qty }} piece available</p>
                                </div>
                            </div>
                            @if ($val->inventory_qty == 0)
                                <p><a type="button" class="btn btn-primary py-3 px-5 mr-2" disabled
                                        onclick="notyf.error('Sorry, Out of Stock');">Add to Cart</a></p>
                            @else
                                <p><a type="button" data-id_product_details="{{ $val->id }}"
                                        class="btn btn-primary py-3 px-5 mr-2 add-to-cart-details">Add to Cart</a></p>
                            @endif
                        </div>
                    </div>
         </form>
                    <div class="row mt-5">
                        <div class="col-md-12 nav-link-wrap">
                            <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill"
                                    href="#v-pills-1" role="tab" aria-controls="v-pills-1"
                                    aria-selected="true">Description</a>

                                <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill"
                                    href="#v-pills-2" role="tab" aria-controls="v-pills-2"
                                    aria-selected="false">Manufacturer</a>

                                <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3"
                                    role="tab" aria-controls="v-pills-3" aria-selected="false">Reviews</a>

                            </div>
                        </div>
                        <div class="col-md-12 tab-wrap">

                            <div class="tab-content bg-light" id="v-pills-tabContent">

                                <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                                    aria-labelledby="day-1-tab">
                                    <div class="p-4">
                                        <h3 class="mb-4">{{ $val->name }}</h3>
                                        <p>{{ $val->description }}</p>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-2" role="tabpanel"
                                    aria-labelledby="v-pills-day-2-tab">
                                    <div class="p-4">
                                        <h3 class="mb-4">Manufactured By Liquor Store</h3>
                                        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it
                                            came from it would have been rewritten a thousand times and everything that was
                                            left from its origin would be the word "and" and the Little Blind Text should
                                            turn around and return to its own, safe country. But nothing the copy said could
                                            convince her and so it didn’t take long until a few insidious Copy Writers
                                            ambushed her, made her drunk with Longe and Parole and dragged her into their
                                            agency, where they abused her for their.</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-3" role="tabpanel"
                                    aria-labelledby="v-pills-day-3-tab">
                                    <div class="row p-4">
                                        <h3 class="mb-4">Your Review</h3>
                                        <div class="review">

                                            {{-- USER IMAGE --}}
                                            {{-- <div class="user-img"
                                                    style="background-image: url(frontend/images/person_1.jpg)">
                                                </div> --}}
                                            <div class="desc pr-5">
                                                @include('errors.error')
                                                <form action="{{ route('home.post', ['id' => $product[0]->id]) }}"
                                                    method="POST" id="postComment">
                                                    @csrf
                                                    {{-- <input type="hidden" name="product_id" value="{{  }}"> --}}

                                                    <span class="my-rating"></span> <span class="live-rating-span"></span>
                                                    <input type="hidden" class="live-rating" name="star" value="">


                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <input type="text" name="fullname" class="form-control mt-4"
                                                                placeholder="Name*">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="email" class="form-control mt-4"
                                                                placeholder="Email*">
                                                        </div>
                                                        <div class="col-12">
                                                            <textarea name="description" class="form-control mt-4"
                                                                placeholder="Description*" rows="5"></textarea>
                                                        </div>
                                                    </div>

                                                    <input class="btn btn-primary mt-4"
                                                       type="submit" value="Post">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-4" id="comment-list">
                                        
                                        <h3 class="mb-4" id="comment-total">{{ $comments->total() }} Reviews</h3>
                                        <div class="review" id="comment-review">
                                            @foreach ($comments as $comment)

                                                {{-- USER IMAGE --}}
                                                {{-- <div class="user-img"
                                            style="background-image: url(frontend/images/person_1.jpg)">
                                            </div> --}}
                                                <div class="desc">
                                                    <h4>
                                                        <span class="text-left">{{ $comment->fullname }}</span>
                                                        <span
                                                            class="text-right">{{ date('Y-m-d', strtotime($comment->created_date)) }}</span>
                                                    </h4>
                                                    <p class="star">
                                                    <div class="my-rating-posted" data-rating="{{ $comment->star }}">
                                                    </div>
                                                    </p>
                                                    <p>{{ $comment->description }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            {{ $comments->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach

            <div class="row mt-5">
                <div class="col-md-12">
                    <h2 class="text-center mb-5">Related Product</h2>
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        <!-- Sản Phẩm Liên Quan  -->
                        @foreach ($related_product as $key => $re_product)
                            <div class="item">
                                <div class="d-flex">
                                    <div class="product ftco-animate">
                                        <form action="">
                                            @csrf
                                            <input type="hidden" class="product_name_cart_{{ $re_product->id }}"
                                                value="{{ $re_product->name }}">
                                            @if ($re_product->price != $re_product->sale_price)
                                                <input type="hidden" class="product_price_cart_{{ $re_product->id }}"
                                                    value="{{ $re_product->sale_price }}">
                                            @else
                                                <input type="hidden" class="product_price_cart_{{ $re_product->id }}"
                                                    value="{{ $re_product->price }}">
                                            @endif
                                            <input type="hidden" class="product_quantity_cart_{{ $re_product->id }}"
                                                value="1">
                                            <input type="hidden" class="product_image_cart_{{ $re_product->id }}"
                                                value="{{ $re_product->featured_image }}">
                                            <div class="img d-flex align-items-center justify-content-center"
                                                style="background-image: url({{ asset('frontend/images/products/' . $re_product->featured_image) }});">
                                                <div class="desc">
                                                    <p class="meta-prod d-flex">
                                                        @if ($re_product->inventory_qty == 0)
                                                            <a type="button" style="cursor: pointer;"
                                                                data-id_product="{{ $re_product->id }}"
                                                                class="d-flex align-items-center justify-content-center"
                                                                onclick="notyf.error('Currently Out of Stock');"><span
                                                                    class="flaticon-shopping-bag"></span></a>
                                                        @else
                                                            <a type="button" style="cursor: pointer;"
                                                                data-id_product="{{ $re_product->id }}"
                                                                class="d-flex align-items-center justify-content-center add-to-cart-related"><span
                                                                    class="flaticon-shopping-bag"></span></a>
                                                        @endif
                                                        <a href="#"
                                                            class="d-flex align-items-center justify-content-center"><span
                                                                class="flaticon-heart"></span></a>

                                                        <a href="{{ url('home/single-product/' . $re_product->id) }}"
                                                            class="d-flex align-items-center justify-content-center"><span
                                                                class="flaticon-visibility"></span></a>
                                                    </p>
                                                </div>

                                            </div>
                                            <div class="text text-center">
                                                @if (date('Y', strtotime($re_product->created_date)) >= 2020)
                                                    <span class="new">New Arrival</span>
                                                @elseif ($re_product->featured)
                                                    <span class="seller">Best Seller</span>
                                                @elseif ($re_product->price!=$re_product->sale_price)
                                                    <span class="sale">Sale</span>
                                                @endif

                                                <span class="category">{{ $re_product->category->name }}</span>
                                                <h2>{{ $re_product->name }}</h2>
                                                <span class="price">$
                                                    @if ($re_product->price != $re_product->sale_price)
                                                        {{ $re_product->sale_price }}
                                                    @else
                                                        {{ $re_product->price }}
                                                    @endif
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
        
                </div>
        </div>
        </div>
    </section>

    {{-- Related Products --}}


@endsection
@section('scripts')
    <script>
        // $(document).ready(function() {
        //     updateAnsweredRating();

        //     // Submit Comment with Ajax
        //     $("form.form-comment").submit(function(event) {
        //     event.preventDefault(); 
        //     var post_url = $(this).attr("action"); 
        //     var request_method = $(this).attr("method"); 
        //     var form_data = $(this).serialize(); 
        //     //display loading...
        //     $.ajax({
        //         url: post_url,
        //         type: request_method,
        //         data: form_data
        //     })
        //     .done(function(data) {
        //         var comments = JSON.parse(data);
        //         var reviewTotal = data.length + " Reviews";
        //         $(comments).each(function (index, el){
        //             var output = "";
        //             $("#comment-total").html(reviewTotal);
        //             $("#comment-review").empty();
        //             $("#comment-review").append(output);
        //         });
        //         updateAnsweredRating();
        //     });
        // });

        $(document).ready(function() {
            updateAnsweredRating();
        });

        $(".my-rating").starRating({
            strokeColor: '#894A00',
            strokeWidth: 10,
            starSize: 25,
            disableAfterRate: true,
            onHover: function(currentIndex, currentRating, $el) {
                $('.live-rating').val(currentIndex);
                $('.live-rating-span').text(currentIndex);
            },
            onLeave: function(currentIndex, currentRating, $el) {
                $('.live-rating').val(currentRating);
                $('.live-rating-span').text(currentRating);
            },
        });

        function updateAnsweredRating() {
            $(".my-rating-posted").starRating({
                activeColor: 'crimson',
                starSize: 15,
                readOnly: true,
            });
        }

    </script>

@endsection
