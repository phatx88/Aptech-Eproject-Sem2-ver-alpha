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
             <a href="{{ route('admin.role.index') }}">Role</a>
         </li>
         <li class="breadcrumb-item active">List</li>
     </ol>
     @include('errors.message')
       <!-- DataTables Example -->
       <div class="card mb-3">
         <div class="card-header">
            <i class="fas fa-table"></i>
            Role List
            <div class="float-right">
                <a href="{{ route('admin.role.create') }}" class="btn btn-primary btn-sm">Add</a>
                <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
            </div>
          </div>
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTable-3" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                        <th class="filter-input">Staff Id</th>
                         <th class="filter-input" >Role Id</th>
                        <th>Action</th>
                        <th></th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($roles as $role)
                      <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td><a href="{{ route('admin.role.edit' , ['role' => $role->id]) }}" class="btn btn-warning btn-sm">Edit</a></td>
                        <td>
                            <form
                                action="{{ route('admin.role.destroy', ['role' => $role->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                     </tr>    
                      @endforeach
                   </tbody>
                   <tfoot>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
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
@endsection
@section('scripts')
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
         //   columnDefs: [{
         //       targets: 2,
         //       render: $.fn.dataTable.render.ellipsis(15, true)
         //   }],
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