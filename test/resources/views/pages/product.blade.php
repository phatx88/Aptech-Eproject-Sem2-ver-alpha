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
                            </div>
                            <div id="compare_block">

                                {{-- <h2>Modal Example</h2> --}}
                                <!-- Trigger the modal with a button -->
                                {{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#compare">Open Modal</button> --}}

                               <!-- Modal -->
                                <div class="modal fade" id="compare" tabindex="-1" role="dialog" style="overflow-y:hidden;">
                                    <div class="modal-dialog">
                                    <div class="modal-content" style="width: fit-content;
                                    height: 850px;
                                    top: 100%;
                                    left: 50%;
                                    margin-top: 440px;
                                    margin-right: -50%;
                                    transform: translate(-50%, -50%)">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><span id="title-compare"></span></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true" style="background-color: white; color: red;">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <table class="table table-striped">
                                                  {{-- <tr>
                                                    <th>Name</th>
                                                    <th>Featured Image</th>
                                                    <th>Price</th>
                                                    <th>Details</th>
                                                    <th>Delete</th>
                                                  </tr> --}}
                                                <tr height="20px">
                                                    <th style="margin: 0px; padding: 5px; text-align: center;" width="33%">Item 1</th>
                                                    <th style="margin: 0px; padding: 5px; text-align: center; " width="33%">Item 2</th>
                                                    <th style="margin: 0px; padding: 5px; text-align: center;" width="33%">Item 3</th>
                                                </tr>
                                                <tr id="row_compare">

                                                </tr>
                                              </table>
                                            </div>
                                        </div>
                                        {{-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        {{-- </div> --}}
                                    </div>
                                    </div>
                                </div>
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

    <script type="text/javascript">
        view_compare();
        function delete_compare(id) {
            // alert(id);
            if(localStorage.getItem('compare') != null){
                var data = JSON.parse(localStorage.getItem('compare'));
                var index = data.findIndex(item => item.id === id);
                // alert(index);
                data.splice(index, 1);
                localStorage.setItem('compare', JSON.stringify(data));
                document.getElementById("row_compare" + id).remove();
            }
        }

        function view_compare(){
            if(localStorage.getItem('compare') != null){
                // alert('have value');
                var data = JSON.parse(localStorage.getItem('compare'));

                var i;

                for(i = 0; i < data.length; i++){
                    var id = data[i].id;
                    var name = data[i].name;
                    var price = data[i].price;
                    var image = data[i].image;
                    var url  = data[i].url;
                    $('#row_compare').append(`

                            <td id="row_compare`+ id +`" class="hover-compare-block">
                                <div class="card">
                                    <img width="100%" height="350px" src="`+ image +`" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">`+ name.substr(0, 20) +`...</h5>
                                        <p>Price: $ `+ price+`</p>
                                        <a class="btn btn-primary" href="`+ url +`">Details</a>
                                        <a class="btn btn-warning" style="cursor: pointer;" onclick="delete_compare(`+id+`)">Delete</a>
                                    </div>
                                </div>
                            </td>
                    `);
                }
            }
        }


        function add_compare(product_id) {
            // $('#compare').modal();
            // alert(product_id);
            document.getElementById('title-compare').innerHTML ='Comparison';
            var id = product_id;
            var name = document.getElementById('product_name_cart_'+id).value;
            var price = document.getElementById('product_price_cart_'+id).value;
            var image = document.getElementById('img_'+id).src;
            var url = document.getElementById('product_detail_'+id).href;

            var newItem ={
                'id': id,
                'name':name,
                'price':price,
                'image':image,
                'url':url
            }
            // alert(newItem);
            if(localStorage.getItem('compare') == null){
                localStorage.setItem('compare', `[]`);
            }

            var old_data = JSON.parse(localStorage.getItem('compare'));

            var matches = $.grep(old_data, function(obj){
                return obj.id == id;
            })

            if(matches.length){
                notyf.error('You have already choosen this items!!!');
            }else{
                if(old_data.length < 3){

                    old_data.push(newItem);

                    $('#row_compare').append(`
                        <td id="row_compare`+ id +`" class="hover-compare-block">
                                <div class="card" >
                                    <img width="100%" height="350px" src="`+ newItem.image +`" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">`+ newItem.name.substr(0, 20) +`...</h5>
                                        <p>Price: $ `+ price+`</p>
                                        <a href="`+ newItem.url +`" class="btn btn-primary">Details</a>
                                        <a class="btn btn-warning" style="cursor: pointer;" onclick="delete_compare(`+id+`)">Delete</a>
                                    </div>
                                </div>
                            </td>
                    `);
                }else{
                    notyf.error('You just can compare 3 items!!!');
                }
            }
            localStorage.setItem('compare', JSON.stringify(old_data));

        }
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
