@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
            <div class="container-fluid">
               <!-- Breadcrumbs-->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="{{ route('admin.dashboard.index') }}">Admin</a>
                  </li>
                  <li class="breadcrumb-item active">User</li>
               </ol>
               <!-- DataTables Example -->
               <div class="action-bar">
                  <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
                  <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
               </div>
               <div class="card mb-3">
                  <div class="card-header">
                     <i class="fas fa-users"></i>
                     User List
                     {{-- <a href="{{ route('admin.order.export') }}" class="btn btn-success btn-sm float-right">Export</a> --}}
                 </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-hover" id="datatableAjax" width="100%" cellspacing="0">
                           @csrf
							<thead>
							  <tr>
                          <th>Id</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Verified At</th>
                          <th>Created At</th>
                          <th>Updated At</th>
                          <th>Mobile</th>
                          <th>Register From</th>
                          <th>Status</th>
                          <th></th>
                          <th>Actions</th>
                       </tr>
							</thead>
							<tfoot>
                        <tr>
                           <th>Id</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Verified At</th>
                           <th>Created At</th>
                           <th>Updated At</th>
                           <th>Mobile</th>
                           <th>Register From</th>
                           <th>Status</th>
                           <th></th>
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
<script>
   $(document).ready(function() {
                $('#datatableAjax').DataTable({
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
                            "data": "is_active"
                        },
                        {
                            "data": "option_show"
                        },
                        {
                            "data": "option_edit"
                        }
                    ]

                });
            });
</script>
@endsection