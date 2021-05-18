@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
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
       @include('errors.error')
       <!-- DataTables Example -->
       <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Transport List
            <div class="float-right">
                <a href="{{ route('admin.newsletter.create') }}" class="btn btn-primary btn-sm">Add</a>
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
                        <td><input type="checkbox"></td>
                        <td>{{$email->email}}</td>
                        <td></td>
                        <td><a href="{{ route('admin.newsletter.edit' , ['newsletter' => $email->email]) }}" class="btn btn-warning btn-sm">Edit</a></td>
                        <td>
                            <form
                                action="{{ route('admin.newsletter.destroy', ['newsletter' => $email->email]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
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
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer');
 </div>
@endsection
