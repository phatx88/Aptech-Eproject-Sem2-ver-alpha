@extends('admin_layout')
@section('admin_content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="{{ route('admin.order.index') }}">Order</a>
              </li>
                <li class="breadcrumb-item">
                  <a href="{{ route('admin.order.edit' , ['order' => $order->id]) }}">Edit</a>
              </li>
                <li class="breadcrumb-item active">Add_Item</li>
            </ol>
            {{-- row --}}
            @include('errors.error')
            @include('errors.message')
            <form class="spacing" method="post" action="{{ route('admin.order.item.store' , ['order' => $order->id]) }}" id="select_product"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}">
                        <label for="" class="control-label">Choose Product: </label>
                        <select name="product_id" id="select_product_id">
                            <option value=""></option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->id }} -- {{ $product->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary btn-sm" type="submit" id="add_product">Add</button>
                    </div>
                </div>
            </form>
            <!-- /.row -->
            <form class="spacing" method="post" action="" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12 ">
                        <label for="name" class="control-label">Order ID: #{{ $order->id }}</label>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onclick="checkAll(this)"></th>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Featured Image</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @foreach ($orderItem as $item)
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><span>{{ $item->product_id }}</span></td>
                                            <td><span>{{ $products->find($item->product_id)->name }}</span></td>
                                            <td><img src="{{ asset('frontend/images/products/' . $products->find($item->product_id)->featured_image) }}">
                                            </td>
                                            <td><span id="unit_price">${{ $item->unit_price }}</span>
                                            </td>
                                            <td><input name="qty" id="qty" type="number" min="0" 
                                             data-url="{{ route('admin.order.item.update', ['order' => $item->order_id , 'item' => $item->product_id]) }}"
                                             data-productid="{{ $item->product_id }}" 
                                             data-unitprice="{{ $item->unit_price }}"
                                             value="{{ $item->qty }}"></td>
                                            <td><span id="total_price" data-value="">${{ $item->total_price }}</span>
                                            </td>
                                            {{-- @can('delete', 'App\Models\OrderItem') --}}
                                            <td>
                                                <form action="{{ route('admin.order.item.destroy' , ['order' => $item->order_id , 'item' => $item->product_id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Delete"
                                                    class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                </form>
                                            </td>
                                            {{-- @endcan --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-action">
                    <a href="{{ route('admin.order.edit', ['order' => $order]) }}" class="btn btn-warning btn-sm" name="edit">Save & Exit</a>
                </div>
                <br>
            </form>
            <!-- /.row -->
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        @include('admin.footer')
    </div>
    <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
@endsection
@section('scripts')
    <script>
       //Ajax editing qty to orderItem
       $(document).on('change', 'input', function () { 
            //  e.preventDefault();
             var product_id = $(this).data('productid');
             var qty = $(this).val();
             var unit_price = $(this).data('unitprice');
             var _token = $('input[name="_token"]').val();
             url = $(this).data('url');
             $.ajax({
                type: "PUT",
                url: url,
                data: {
                   product_id : product_id,
                   qty : Number(qty),
                   unit_price : Number(unit_price),
                   _token : _token,
                },
                success: function (response) {
                  window.location.reload();
                }
             });
       });

    </script>
@endsection
