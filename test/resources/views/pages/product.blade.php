@extends('main_layout')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('frontend/images/bg_2.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Products <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Products</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                {{-- SIDE BAR --}}
                <div class="col-md-3">
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Product Types</h3>
                            <ul class="p-0">
                                @foreach ($all_cate as $cate)
                                    <li><a href="{{ route('home.products.index', ['id' => $cate->id]) }}">{{ $cate->name }}
                                            <span class="fa fa-chevron-right"></span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Product Featured</h3>
                            <ul class="p-0">
                                <li><a href="#">On Sale <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="#">Best Seller <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="#">latest Arrival <span class="fa fa-chevron-right"></span></a></li>
                            </ul>
                        </div>
                    </div>

                    {{-- Slider --}}


                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Price Range</h3>
                            <div id="slider-snap">
                            </div>
                            <br>
                            <span class="">Value : </span><span class="price from" id="slider-snap-value-lower"></span> - <span class="price to" id="slider-snap-value-upper"></span>
                            <form action="{{ url('home/products/search_price') }}" id="price-search" method="POST">
                                @csrf
                                <input type="hidden" class="price_from" id="input-format-from" name="price_from" value="">
                                <input type="hidden" class="price_to" id="input-format-to" name="price_to" value="">
                                <input type="submit" value="search" class="search_price">
                            </form>
                        </div>

                    </div>

                    {{-- Slider --}}
                    <div class="sidebar-box ftco-animate">
                        <h3>Recent Blog</h3>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                                style="background-image: url({{ asset('frontend/images/image_1.jpg') }});"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                                style="background-image: url({{ asset('frontend/images/image_2.jpg') }});"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                                style="background-image: url({{ asset('frontend/images/image_3.jpg') }});"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- SIDE BAR --}}

                {{-- MAIN CONTAIN --}}

                <div class="col-md-9">
                    <div class="row mb-4">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            {{-- SEARCH BAR BEGIN --}}
                            <form action="{{ route('home.products.index') }}" method="GET" class="search">
                                <div class="search__wrapper">
                                    <input type="text" name="search" placeholder="Select Types of Products"
                                        class="search__field">
                                    <button type="submit" class="fa fa-search search__icon"></button>
                                </div>
                            </form>
                            {{-- SEARCH BAR END --}}
                            <select class="selectpicker">
                                <option>Brandy</option>
                                <option>Gin</option>
                                <option>Rum</option>
                                <option>Tequila</option>
                                <option>Vodka</option>
                                <option>Whiskey</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        @foreach ($products as $product)
                            <div class="col-md-4 d-flex">
                                <div class="product ftco-animate">
                                    <div class="img d-flex align-items-center justify-content-center"
                                        style="background-image: url('{{ asset('frontend/images/products/' . $product->featured_image) }}');">
                                        {{-- <img class="" style="position: absolute; width: 100%; height: 350px; z-index: -1;" src="{{ asset('frontend/images/products/'.$product->featured_image) }}" alt=""> --}}
                                        <div class="desc">
                                            <p class="meta-prod d-flex">
                                                <a href="#" class="d-flex align-items-center justify-content-center"><span
                                                        class="flaticon-shopping-bag"></span></a>
                                                <a href="#" class="d-flex align-items-center justify-content-center"><span
                                                        class="flaticon-heart"></span></a>
                                                <a href="#" class="d-flex align-items-center justify-content-center"><span
                                                        class="flaticon-visibility"></span></a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="text text-center">

                                        @if (date('Y', strtotime($product->created_date)) >= 2020)
                                            <span class="new">New Arrival</span>
                                        @elseif ($product->featured)
                                            <span class="seller">Best Seller</span>
                                        @elseif ($product->price!=$product->sale_price)
                                            <span class="sale">Sale</span>

                                        @endif
                                        <span class="category">{{ $product->category_name }}</span>
                                        <h2>{{ $product->brand_name }}</h2>
                                        <p class="mb-0">

                                            @if ($product->price != $product->sale_price)
                                                <span class="price price-sale">${{ $product->price }}</span>
                                            @endif
                                            <span class="price">${{ $product->sale_price }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                <ul>
                                    <li>{{ $products->links() }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- MAIN CONTAIN --}}
            </div>
        </div>
    </section>

@endsection
