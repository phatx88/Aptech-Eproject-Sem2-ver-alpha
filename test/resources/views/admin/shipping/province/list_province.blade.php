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
             <a href="{{ route('admin.province.index') }}">Shipping</a>
         </li>
         <li class="breadcrumb-item active">List</li>
     </ol>
     @include('errors.message')
       <!-- DataTables Example -->
       {{-- <div class="card mb-3">
         <div class="card-header">
            <i class="fas fa-table"></i>
            Shipping
            <div class="float-right">
                <a href="{{ route('admin.transport.create') }}" class="btn btn-primary btn-sm">Add</a>
                <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                <a href="#" class="btn btn-success btn-sm">Export</a>
            </div>
          </div>
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTable-3" width="100%" cellspacing="0">
                   <thead>
                      <tr>

                        <th class="filter-input">id</th>
                        <th class="filter-input">name</th>
                        <th class="filter-select">type</th>
                        <th>district_id</th>
                        <th></th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($shippings as $ward)
                      <tr>
                        <td>{{ $ward->id }}</td>
                        <td>{{ $ward->name }}</td>
                        <td>{{ $ward->type }}</td>
                        <td>{{ $ward->district_id }}</td>
                        <td><a href="" class="btn btn-warning btn-sm">Edit</a></td>
                     </tr>
                      @endforeach
                   </tbody>
                   <tfoot>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                   </tfoot>
                </table>
             </div>
          </div>
       </div> --}}

       <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Order List
            <div class="float-right">
                {{-- <a type="button" href="{{ route('admin.province.create') }}" class="btn btn-primary btn-sm" value="Thêm"
                name="add">Add</a> --}}
                <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                <a href="{{ route('admin.order.export') }}" class="btn btn-success btn-sm">Export</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatableAjax" class="table table-hover text-center" style="width:100%">
                    @csrf
                    <thead>
                        <tr>
                            <th>Province Id</th>
                            <th>Province Name</th>
                            <th>Province Type</th>
                            {{-- <th>Province Order_count</th>
                            <th>Province Delivered_count</th> --}}
                            <th>Actions</th>


                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>
                                <input type="search" class="form-control form-control-sm filter-input" data-column="0" placeholder="Search">
                            </th>
                            <th>
                                <input type="search" class="form-control form-control-sm filter-input" data-column="1" placeholder="Search">
                            </th>
                            <th>
                                <input type="search" class="form-control form-control-sm filter-input" data-column="2" placeholder="Search">
                            </th>
                            {{-- <th>
                                <input type="search" class="form-control form-control-sm filter-input" data-column="3" placeholder="Search">
                            </th> --}}

                            <th></th>


                        </tr>
                    </tfoot>
                </table>
                <div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer')
 </div>
@endsection
@section('scripts')
{{-- <script>
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

</script> --}}
<script>
    $(document).ready(function() {
        var table = $('#datatableAjax').DataTable({
            "order": [
                [0, "desc"]
            ],
            "autoWidth": 'TRUE',
            "scrollX": 'TRUE',
            "lengthMenu": [
                [5, 10, 25, 50, 100, 500, 1000],
                [5, 10, 25, 50, 100, 500, 1000]
            ],
            "columnDefs": [{
                // targets: 8,
                // render: $.fn.dataTable.render.ellipsis(30, true)
            }],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url('fetch-province') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    _token: "{{ csrf_token() }}"
                }
            },
            "columns": [
                {
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "type"
                },
                // {
                //     "data": "order_count"
                // },
                // {
                //     "data": "delivered_count"
                // },
                {
                    "data": "option_edit"
                },


            ],
        });

        $('.filter-input').on( 'keyup change' , function () {
                table.column( $(this).data('column') )
                .search( $(this).val() )
                .draw();
            });

        $('.filter-select').on( 'change', function () {
            table.column( $(this).data('column') )
            .search( $(this).val() )
            .draw();
        });

    });

</script>
@endsection
