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
                    <a href="{{ route('admin.user.index') }}">User</a>
                 </li>
                  <li class="breadcrumb-item active">List</li>
               </ol>
               @include('errors.message')
                {{-- GOOGLE CALENDAR CHART --}}

                <div class="row mb-3">
                    <div class="col-12 col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-file-invoice-dollar"></i>
                                Revenue Per Customer Report
                            </div>
                            <div class="card-body">
                                <div id="piechart_3d" style="width: 100%; height: 500px;"
                                data-url="{{ url('fetch-users-value-data') }}"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-user-ninja"></i>
                                Unverified Users
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="dataTable-3" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Id</th>
                                                <th>Email</th>
                                                <th>Created_at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 0;
                                            @endphp
                                            @foreach ($users as $user)
                                                <tr class="text-center">
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->created_at }}</td>
                                                    <td>
                                                        <form
                                                        action="{{ route('admin.user.destroy', ['user' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you Sure?')">
                                                    </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <!-- DataTables Example -->
               <div class="card mb-3">
                  <div class="card-header">
                     <i class="fas fa-users"></i>
                     User List
                     <div class="float-right">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">Add</a>
                        <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                    </div>
                 </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-hover text-center" id="datatableAjax" width="100%" cellspacing="0">
                           @csrf
							<thead>
							  <tr>
                          <th>User Id</th>
                          <th>User Name</th>
                          <th>User Email</th>
                          <th>Verified At</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th>Mobile</th>
                          <th>Register From</th>
                          <th>last_login_at</th>
                          <th>Total Order</th>
                          <th>Total Spent</th>
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
                           <th>
                            <input type="search" class="form-control form-control-sm filter-input" data-column="3" placeholder="Search">
                           </th>
                           <th>
                            <input type="search" class="form-control form-control-sm filter-input" data-column="4" placeholder="Search">
                           </th>
                           <th>
                            <input type="search" class="form-control form-control-sm filter-input" data-column="5" placeholder="Search">
                           </th>
                           <th>
                            <input type="search" class="form-control form-control-sm filter-input" data-column="6" placeholder="Search">
                           </th>
                           <th>
                            <select class="form-control form-control-sm filter-select" data-column="7">
                                @foreach ($providers as $provider)
                                <option value="{{ $provider }}">{{ $provider ?? 'Select'}}</option>
                                @endforeach
                            </select>
                           </th>
                           <th>
                            <input type="search" class="form-control form-control-sm filter-input" data-column="8" placeholder="Search">
                           </th>
                           <th>
                            <input type="search" class="form-control form-control-sm filter-input" data-column="9" placeholder="Search">
                           </th>
                           <th>
                            <input type="search" class="form-control form-control-sm filter-input" data-column="10" placeholder="Search">
                           </th>
                           <th>Actions</th>
                        </tr>
                     </tfoot>
                     </table>
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var url = $('#piechart_3d').data('url');
        //step 1 : Get data from laravel controller via route
        var jsonData = $.ajax({
            url: url,
            dataType: "json",
            async: false
        }).responseText;
        //step 2 : parse JSON to js Array of Obj
        var arrObj = JSON.parse(jsonData);
        var arrdata = [];
        //step 3 : loop through each obj convert into array of value : value
        $.each(arrObj, function(k, obj) {
            var data = Object.keys(obj).map(function(key) {
                return obj[key];
            });
            //step 4 : insert each array(v,v) to array of data
            arrdata.push(data);
        });
        // console.log(arrdata);
         // Step 5 : change element of array to desired type 
         $.each(arrdata, function(k, v) {
                    v[1] = Number(v[1]);
        });
        

        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn({
            type: 'string',
            id: 'Users'
        });
        dataTable.addColumn({
            type: 'number',
            id: 'Dollars Spend'
        });
        dataTable.addRows(arrdata);

    var options = {
      title: 'Most Valuable Customers (in $)',
      sliceVisibilityThreshold: .01,
      is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(dataTable, options);
  }

  $(window).resize(function(){
            drawChart();
            });
</script>

<script>
    $(document).ready(function() {
        var table = $('#dataTable-3').DataTable({
            // flipping horizontal scroll bar in datatables refer to admin.css line 94
            order: [
                [0, "asc"]
            ],
            autoWidth: 'TRUE',
            scrollX: 'TRUE',
            lengthMenu: [
                [6, 25, 50, -1],
                [6, 25, 50, "All"]
            ],
            columnDefs: [{
                targets: [1,2],
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

<script>
   $(document).ready(function() {
    var table = $('#datatableAjax').DataTable({
                    "order": [[ 0, "desc" ]],
                    "autoWidth": 'TRUE',
                    "scrollX": 'TRUE',
                    "lengthMenu": [
                        [5, 10, 25, 50, 100, -1],
                        [5, 10, 25, 50, 100, "All"]
                    ],
                    "columnDefs": [ {
                    targets: 2,
                    render: $.fn.dataTable.render.ellipsis( 15, true )
                    } ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ url('fetch-user') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data": {
                            _token: "{{ csrf_token() }}"
                        }
                    },
                    "columns": [{
                            "data": "id"
                        },
                        {
                            "data": "name"
                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "email_verified_at"
                        },
                        {
                            "data": "created_at"
                        },
                        {
                            "data": "updated_at"
                        },
                        {
                            "data": "mobile"
                        },
                        {
                            "data": "provider"
                        },
                        {
                            "data": "last_login_at"
                        },
                        {
                            "data": "total_ordered"
                        },
                        {
                            "data": "amount_spent"
                        },
                        {
                            "data": "option_edit"
                        },
                        // {
                        //     "data": "option_delete",
                        //     render : function (data) {  
                        //         return  ` 
                        //                     <td>
                        //                     <form action='` + data + `' method='POST'>
                        //                         @csrf
                        //                         @method('delete')
                        //                         <input type='submit' value='Delete'
                        //                         class='btn btn-danger btn-sm' onclick="return confirm('Are You Sure?')">
                        //                     </form>
                        //                     </td>
                                           
                        //                 `;
                        //     }
                        
                        
                    ]

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