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
                    <a href="{{ route('admin.product.index') }}">Product</a>
                </li>
                <li class="breadcrumb-item active">List</li>
            </ol>
             {{-- Chart Larapex --}}
               {{-- Chart Larapex --}}
            <div class="row mb-3">
            <div class="col-md-6">
               <div class="card">
                  <div class="card-header">
                     <i class="fas fa-heart"></i>
                     Most Viewed Items Chart
                  </div>
                     <div class="card-body">
                        {!! $productChart->container() !!}
                     </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="card">
                  <div class="card-header">
                     <i class="fas fa-shopping-basket"></i>
                     Best Selling Items Chart
                  </div>
                     <div class="card-body">
                        {!! $orderChart->container() !!}
                     </div>
               </div>
            </div>
         </div>
            {{-- MESSAGE  --}}
            @include('errors.message')
            <!-- DataTables Example -->
            
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Product List
                    <div class="float-right">
                        @can('create', 'App\Models\Product')
                        <a href="{{ route('admin.product.create') }}" 
                        class="btn btn-primary btn-sm">Add</a>
                        @endcan
                        <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                        <a href="{{ route('admin.product.export') }}" class="btn btn-success btn-sm">Export</a>
                    </div>
                 </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    {{-- <th><input type="checkbox" onclick="checkAll(this)"></th> --}}
                                    <th>Show</th>
                                    <th>ID</th>
                                    <th style="width:50px">Name </th>
                                    <th>Featured Image</th>
                                    <th>Price</th>
                                    <th>% Discount</th>
                                    <th>Sale Price</th>
                                    <th>Discout Date From</th>
                                    <th>Discout Date To</th>
                                    <th>Inventory</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Description</th>
                                    <th>Created Date</th>
                                    <th>Featured</th>
                                    @can('update', 'App\Models\Product')
                                    <th>Hidden</th>
                                    @endcan
                                    <th></th>
                                    <th></th>
                                    @can('update', 'App\Models\Product')
                                    <th></th>
                                    @endcan
                                    @can('delete', 'App\Models\Product')
                                    <th></th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody >
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <td><input type="checkbox" {{ $product->hidden == 0 ? 'checked' : "" }}></td>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ asset('frontend/images/products/' . $product->featured_image) }}">
                                        </td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ $product->discount_percentage == 0 ? 'N/A' : $product->discount_percentage . '%' }}
                                        </td>
                                        <td>${{ round(($product->price * (100 - $product->discount_percentage)) / 100, 2) }}
                                        </td>
                                        <td>{{ $product->discount_from_date == 0 ? 'N/A' : $product->discount_from_date }}
                                        </td>
                                        <td>{{ $product->discount_to_date == 0 ? 'N/A' : $product->discount_to_date }}</td>

                                        <td>{{ $product->inventory_qty }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->brand->name }}</td>
                                        <td><button class="btn btn-info btn-sm m-auto" data-toggle="modal" data-target="#ModalDescription"
                                                data-description="{{ $product->description }}"
                                                data-title="{{ $product->name }}">Show</button></td>
                                        <td>{{ $product->created_date }}</td>
                                        <td>{{ $product->featured == 1 ? 'yes' : 'no' }}</td>
                                        @can('update', 'App\Models\Product')
                                        <td>
                                            @if($product->hidden == 0)
                                            <a class="btn btn-danger btn-sm" href="{{ url('admin/product/status/'.$product->id) }}">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </a>
                                            @else
                                            <a class="btn btn-success btn-sm" href="{{ url('admin/product/status/'.$product->id) }}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                        </td>
                                        @endcan
                                        <td><a href="{{ URL('admin/comment/'.$product->id) }}">Comments</a></td>
                                        <td><a href="../../pages/image/list.html">Hình ảnh</a></td>
                                        @can('update', 'App\Models\Product')
                                        <td><a href="{{ route('admin.product.edit', ['product' => $product->id]) }}"
                                            class="btn btn-warning btn-sm">Edit</a></td>
                                        @endcan
                                        @can('delete', 'App\Models\Product')
                                        <td>
                                            <form action="{{ route('admin.product.destroy' , ['product' => $product->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete"
                                                class="btn btn-danger btn-sm">
                                            </form>
                                        </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

        {{-- Description Modal --}}
        <div class="modal fade" id="ModalDescription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                           <label class="col-md-12 control-label" for="description">Description</label>
                           <div class="col-md-12">
                              <textarea name="description" id="description" class="form-control" rows="10" cols="60"></textarea>
                           </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        @include('admin.footer')
    </div>
    <!-- /.content-wrapper -->
    @section('scripts')
    <script type="text/javascript" src="{{ asset('backend/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
      $(document).ready(function() {

        //   CKEDITOR.replace('description')
          $('#ModalDescription').on('show.bs.modal', function(event) {
            //   even.preventDefault()
              var button = $(event.relatedTarget) // Button that triggered the modal
              var description = button.data('description') // Extract info from data-* attributes
              var title = button.data('title') // Extract info from data-* attributes
              // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
              // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
              var modal = $(this)
              modal.find('.modal-title').text('Product Name : ' + title)
              modal.find('#description').val(description)
          })


      });

  </script>
  {{ $productChart->script() }}
  {{ $orderChart->script() }}
    @endsection


@endsection


