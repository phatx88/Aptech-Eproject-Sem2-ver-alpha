@extends('main_layout')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('frontend/images/bg_2.jpg') }}');">
        <div
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
                        <div class="col-lg-6 mb-5 ftco-animate gallery">
                            <a href="{{ asset('frontend/images/products/' . $val->featured_image) }}"
                                class="prod-img-bg">
                            <img width="100%"
                                src="{{ asset('frontend/images/products/' . $val->featured_image) }}"
                                class="img-fluid" alt="Colorlib Template">
                            </a>
                        @foreach ($ImageItems as $ImageItem)
                            <a href="{{ asset('frontend/images/gallery/'. $ImageItem->name) }}"
                            class="">
                            </a>
                         @endforeach
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
                <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1"
                        role="tab" aria-controls="v-pills-1" aria-selected="true">Description</a>

                    <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                        role="tab" aria-controls="v-pills-2" aria-selected="false">Manufacturer</a>

                    <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab"
                        aria-controls="v-pills-3" aria-selected="false">Reviews</a>

                </div>
            </div>
            <div class="col-md-12 tab-wrap">

                <div class="tab-content bg-light" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                        <div class="p-4">
                            <h3 class="mb-4">{{ $val->name }}</h3>
                            <p>{{ $val->description }}</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
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
                    <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                        <div class="row p-4">
                            <h3 class="mb-4">Your Review</h3>
                            <div class="review">

                                {{-- USER IMAGE --}}
                                {{-- <div class="user-img"
                                                    style="background-image: url(frontend/images/person_1.jpg)">
                                                </div> --}}
                                <div class="desc pr-5">
                                    {{-- AJax load error messages --}}
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>
                                    {{-- AJax load error messages --}}

                                    <form action="{{ route('home.post', ['id' => $product[0]->id]) }}" method="POST"
                                        id="postComment">
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

                                    </form>
                                    <input class="btn btn-primary mt-4" id="submitPost" value="Post">
                                </div>
                            </div>
                        </div>
                        <div class="row p-4" id="comment-list">

                            <h3 class="mb-4" id="comment-total" data-total="{{ $comments->total() }}">
                                {{ $comments->total() }} Reviews</h3>
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
                    @foreach ($related_product as $product)
                        <div class="item">
                            <div class="d-flex">
                           
                                @include('layouts.product')

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
    {{-- Ajax loading Comment Section --}}
    <script>
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

        $("input#submitPost").click(function(event) {
            event.preventDefault();
            var post_url = $("form#postComment").attr("action");
            var request_method = $("form#postComment").attr("method");
            var form_data = $("form#postComment").serialize();
            console.log(form_data);
            // Clear Error Message
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'none');

           //display Sweet Alert...

            $.ajax({
                url: post_url,
                type: request_method,
                data: form_data,
                success: function(data) {
                    //create object with key of the array
                    var comments = JSON.parse(data);
                    // console.log(comments);

                    //add one more to total Reviews count
                    var reviewTotal = $("#comment-total").data('total');
                    reviewTotal = reviewTotal + 1 + " Reviews";

                    // clear Comment session
                    $("#comment-total").empty();
                    $("#comment-review").empty();
                    $("#comment-review").html('loading...');

                    //Delay updating Comment session for 1s
                    setTimeout(function() {
                        // update toltal count
                        $("#comment-total").html(reviewTotal);

                        // clear Comment session with loading...
                        $("#comment-review").empty();

                        //append foreach
                        $(comments).each(function(key, value) {
                            var output =
                                `<div class="desc">
                                <h4>
                                <span class="text-left">` + value.fullname + `</span>
                                <span class="text-right">` + value.created_date + `</span>
                                </h4>
                                    <p class="star">
                                        <div class="my-rating-posted" data-rating="` + value.star + `"></div>
                                    </p>
                                    <p>` + value.description + `</p>
                                </div>`;
                            $("#comment-review").append(output);
                        });
                        updateAnsweredRating();

                         // Notify success
                        notyf.success('Comment Posted');
                    }, 2000);

                },
                error: function(data) {
                    // Chuyển từ json về array có key và value
                    var errors = data.responseJSON;
                    printErrorMsg(errors);
                    notyf.error('Posting Error!');
                }
            });
        });

        //update lại mấy cái star
        function updateAnsweredRating() {
            $(".my-rating-posted").starRating({
                activeColor: 'crimson',
                starSize: 15,
                readOnly: true,
            });
        };

        //nhận báo lội từ server qua phương thức Validator bằng Ajax
        function printErrorMsg(msg) {

            //Display Error HTML
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                var errors = `<li>` + value + `</li>`;
                $(".print-error-msg").find("ul").append(errors);
            });
        }

    </script>

@endsection
