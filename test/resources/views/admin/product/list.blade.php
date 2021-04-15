@extends('admin_layout')
@section('admin_content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Quản lý</a>
                </li>
                <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
            <!-- DataTables Example -->
            <div class="action-bar">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">Add</a>
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
            </div>
            <div class="card mb-3">
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="text-overflow: ellipsis">
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($products as $product)
                                    <tr style="text-overflow: ellipsis">
                                        <td><input type="checkbox" {{ $product->hidden == false ? 'checked' : "" }}></td>
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
                                        <td><a href="../../pages/comment/list.html">Đánh giá</a></td>
                                        <td><a href="../../pages/image/list.html">Hình ảnh</a></td>
                                        <td><a href="{{ route('admin.product.edit', ['product' => $product->id]) }}"
                                                class="btn btn-warning btn-sm">Edit</a></td>
                                        <td><input type="button" onclick="Delete('25');" value="Xóa"
                                                class="btn btn-danger btn-sm"></td>
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
         
        //    CKEDITOR.replace('description')
        //   CKEDITOR.instances['cke_desciption'].updateElement(description)
          
          $('#ModalDescription').on('show.bs.modal', function(event) {
            //   even.preventDefault()
              var button = $(event.relatedTarget) // Button that triggered the modal
              var description = button.data('description') // Extract info from data-* attributes
              var title = button.data('title') // Extract info from data-* attributes
              // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
              // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
              var modal = $(this)
              modal.find('.modal-title').text('Product Name : ' + title)
              modal.find('.modal-body textarea').val(description)
          })

         
      });
  </script>
    @endsection
    

@endsection
