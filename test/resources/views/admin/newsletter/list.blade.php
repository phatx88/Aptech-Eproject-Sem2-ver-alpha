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
             <a href="{{ route('admin.newsletter.index') }}">Newsletter</a>
         </li>
         <li class="breadcrumb-item active">List</li>
     </ol>
       @include('errors.message')
       <!-- DataTables Example -->
       <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            NewsLetter List
            <div class="float-right">
                <a href="{{ route('admin.newsletter.create') }}" class="btn btn-primary btn-sm">Add</a>
                <button form="deleteAll" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete will remove email from record. Are you sure?')">Select Delete</button>
                <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                <a href="#" class="btn btn-success btn-sm">Export</a>
            </div>
          </div>
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                         <th><input type="checkbox" onclick="checkAll(this)"></th>
                         <th>Email</th>
                         <th></th>
                         <th></th>
                         <th></th>
                      </tr>
                   </thead>
                       <tbody>
                           @foreach ($emails as $email)
                           <tr>
                               <td><input type="checkbox" name="checkboxes[]" value="{{ $email->email }}" form="deleteAll"></td>
                               <td>{{$email->email}}</td>
                               <td></td>
                               <td><a href="{{ route('admin.newsletter.edit' , ['newsletter' => $email->email]) }}" class="btn btn-warning btn-sm">Edit</a></td>
                               <td>
                                   <form
                                   action="{{ route('admin.newsletter.destroy', ['newsletter' => $email->email]) }}"
                                   method="POST" id="delete">
                                   @csrf
                                   @method('DELETE')
                                   <input type="submit" value="Delete" class="btn btn-danger btn-sm" form="delete">
                                   </form>
                               </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <form action="{{ url('admin/newsletter/delete') }}" id="deleteAll" method="Post">
                    @csrf
                    </form>
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
<script language="JavaScript">
    function checkAll(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
    }
    </script>  
@endsection
