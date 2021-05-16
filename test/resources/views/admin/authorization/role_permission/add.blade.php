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
             <a href="{{ route('admin.permission_role.index') }}">Permission-Roles</a>
         </li>
         <li class="breadcrumb-item active">Add</li> 
     </ol>
     @include('errors.error')
       <!-- /form -->
       <form method="post" action="{{ route('admin.permission_role.store') }}" enctype="multipart/form-data">
         @csrf
          <label class="col-md-12 control-label">Role: {{ $role->name }}</label> 
          <input type="hidden" value="{{ $role->id }}" name="role_id">
          <div class="form-group row">
             <div class="ol-md-9 col-lg-6 form-group">
                <select name="permission_id" id="permission_id" class="form-control">
                   <option value=""></option>
                   @foreach ($permissions as $permission)
                   <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                   @endforeach
                </select>
             </div>
             
          </div>
          <div class="form-action">
             <input type="submit" class="btn btn-primary btn-sm" value="Save" name="save">
          </div>
       </form>
       <!-- /form -->
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer')
 </div>
 <!-- /.content-wrapper -->
@endsection