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
                                <li><a href="{{ route('home.products.index', ['id' => 'sale']) }}">On Sale <span
                                            class="fa fa-chevron-right"></span></a></li>
                                <li><a href="{{ route('home.products.index', ['id' => 'best']) }}">Best Seller <span
                                            class="fa fa-chevron-right"></span></a></li>
                                <li><a href="{{ route('home.products.index', ['id' => 'new']) }}">latest Arrival <span
                                            class="fa fa-chevron-right"></span></a></li>
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
                            <span class="">Value : </span><span class="price from" id="slider-snap-value-lower"></span> -
                            <span class="price to" id="slider-snap-value-upper"></span>
                            <form action="{{ url('home/products/') }}" id="price-search" method="GET"
                                style="text-align: center;">
                                {{-- @csrf --}}
                                <input type="hidden" class="price_from" id="input-format-from" name="price_from"
                                    value="{{ $price_from ?? 0 }}">
                                <input type="hidden" class="price_to" id="input-format-to" name="price_to"
                                    value="{{ $price_to ?? 1000 }}">
                                <input type="submit" value="Search" class="btn btn-primary search_price">
                            </form>
                        </div>

                    </div>

                    {{-- Slider --}}
                    <div class="sidebar-box ftco-animate">
                        <h3>Top View Product</h3>
                        @foreach($product_top_view as $key => $view_product)
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                            style="background-image: url('{{ asset('frontend/images/products/' . $view_product->featured_image) }}');"></a>
                            <div class="text">
                                <h3 class="heading"><a href="{{ url('home/single-product/' . $view_product->id) }}">{{ $view_product->name }}</a></h3>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                {{-- SIDE BAR --}}

                {{-- MAIN CONTAIN --}}
                <div class="col-md-9">
                    <div class="row mb-4">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            {{-- SEARCH BAR BEGIN --}}
                            <form action="{{ url('home/products/') }}" class="search-form w-75 m-auto">
                                <div class="form-group">
                                    <span class="fa fa-search"></span>
                                    <input type="text" class="typeahead form-control" style="font-size: 1.2rem;"
                                        name="search" placeholder="Type a keyword and hit enter"
                                        value="{{ $search }}">

                                </div>
                            </form>
                            {{-- SEARCH BAR END --}}
                            <div class="form-group">
                                <form action="">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="orderBy" id="orderBy" class="form-control" onchange="this.form.submit()">
                                        <option value="">Select</option>
                                        <option value="ASC">Ascending</option>
                                        <option value="DESC">Descending</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @foreach ($products as $product)
                            <div class="col-md-4 d-flex">

                                @include('layouts.product')

                            </div>
                        @endforeach

                    </div>
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27">
                                <ul>
                                    <li>{{ $products->appends(request()->input())->links() }}</li>
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

@section('scripts')
<script>
        var path = "{{ route('find') }}";
        $('input.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
</script>

@endsection
