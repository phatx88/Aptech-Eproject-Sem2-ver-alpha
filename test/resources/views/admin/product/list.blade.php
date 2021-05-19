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
            {{-- MESSAGE --}}
            @include('errors.message')
            <!-- DataTables Example -->

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Product List
                    <div class="float-right">
                        @can('create', 'App\Models\Product')
                            <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">Add</a>
                        @endcan
                        <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                        <a href="{{ route('admin.product.export') }}" class="btn btn-success btn-sm">Export</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center" id="dataTable-3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    {{-- <th><input type="checkbox" onclick="checkAll(this)"></th> --}}
                                    <th>Show</th>
                                    <th class="filter-input">Product Id</th>
                                    <th class="filter-input">Product Name </th>
                                    <th>Featured Image</th>
                                    <th class="filter-input">Unit Price</th>
                                    <th class="filter-input">% Discount</th>
                                    <th class="filter-input">Sale Price</th>
                                    <th class="filter-input">Discout Date From</th>
                                    <th class="filter-input">Discout Date To</th>
                                    <th class="filter-input">Inventory</th>
                                    <th class="filter-select">Category</th>
                                    <th class="filter-select">Brand</th>
                                    <th>Description</th>
                                    <th class="filter-input">Created Date</th>
                                    <th class="filter-select">Featured</th>
                                    <th>Hidden</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <td><input type="checkbox" {{ $product->hidden == 0 ? 'checked' : '' }}></td>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img class="d-block m-auto"
                                                src="{{ asset('frontend/images/products/' . $product->featured_image) }}">
                                        </td>
                                        <td>${{ $product->price }}</td>
                                        <td>{{ $product->discount_percentage == 0 ? 'N/A' : $product->discount_percentage . '%' }}
                                        </td>
                                        <td>${{ round(($product->price * (100 - $product->discount_percentage)) / 100, 2) }}
                                        </td>
                                        <td>{{ $product->discount_from_date ?? 'N/A' }}
                                        </td>
                                        <td>{{ $product->discount_to_date ?? 'N/A' }}</td>

                                        <td>{{ $product->inventory_qty }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->brand->name }}</td>
                                        <td><button class="btn btn-info btn-sm m-auto" data-toggle="modal"
                                                data-target="#ModalDescription"
                                                data-description="{{ $product->description }}"
                                                data-title="{{ $product->name }}">Show</button></td>
                                        <td>{{ $product->created_date }}</td>
                                        <td>{{ $product->featured == 1 ? 'yes' : 'no' }}</td>
                                        <td>
                                                @can('update', 'App\Models\Product')
                                                @if ($product->hidden == 0)
                                                    <a class="btn btn-danger btn-sm"
                                                        href="{{ url('admin/product/status/' . $product->id) }}">
                                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                    </a>
                                                @else
                                                    <a class="btn btn-success btn-sm"
                                                        href="{{ url('admin/product/status/' . $product->id) }}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                                @endcan
                                        </td>
                                        <td><a href="{{ URL('admin/comment/' . $product->id) }}">Comments</a></td>
                                        <td><a href="{{ URL('admin/ImageItem/' . $product->id) }}">Images</a></td>
                                        <td>
                                                @can('update', 'App\Models\Product')
                                                <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan
                                        </td>
                                        <td>
                                                @can('delete', 'App\Models\Product')
                                                <form
                                                    action="{{ route('admin.product.destroy', ['product' => $product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                                </form>
                                                @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    {{-- <th><input type="checkbox" onclick="checkAll(this)"></th> --}}
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                        <th></th>
                                    <th></th>
                                    <th></th>
                                        <th></th>
                                        <th></th>
                                </tr>
                            </tfoot>
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
                                <textarea name="description" id="description" class="form-control" rows="10"
                                    cols="60"></textarea>
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
@endsection
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

    <script>
        $(document).ready(function() {
            var table = $('#dataTable-3').DataTable({
                // flipping horizontal scroll bar in datatables refer to admin.css line 94
                order: [
                    [1, "asc"]
                ],
                autoWidth: 'TRUE',
                scrollX: 'TRUE',
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                columnDefs: [{
                    targets: 2,
                    render: $.fn.dataTable.render.ellipsis(15, true)
                }],
            });

            //SEARCH INPUT BY COLUMNS// - put class on top of header

            table.columns('.filter-input').every(function(i) {
                var column = table.column(i);

                // Create the select list and search operation
                var input = $(`<input type='search' class='form-control form-control-sm' placeholder='Search'>`)
                    .appendTo(
                        this.footer()
                    )
                    .on('keyup change', function() {
                        column
                            .search($(this).val())
                            .draw();
                    });
            });

            //SEARCH INPUT BY COLUMNS//


            //SEARCH SELECT BY COLUMNS//

            table.columns('.filter-select').every(function(i) {
                var column = table.column(i);

                // Create the select list and search operation
                var select = $(`<select class='form-control form-control-sm'/>`)
                    .appendTo(
                        this.footer()
                    )
                    .on('change', function() {
                        column
                            .search($(this).val())
                            .draw();
                    });

                // Get the search data for the first column and add to the select list
                select.append($('<option value="">Select</option>'));
                this
                    .cache('search')
                    .sort()
                    .unique()
                    .each(function(d) {
                        select.append($('<option value="' + d + '">' + d + '</option>'));
                    });
            });

            //SEARCH SELECT BY COLUMNS//

        });

    </script>
@endsection
