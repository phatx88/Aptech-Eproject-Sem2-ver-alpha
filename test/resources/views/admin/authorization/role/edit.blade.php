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
         <li class="breadcrumb-item active">Edit</li>
     </ol>
     @include('errors.error')
       <!-- /form -->
       <form class="form-horizontal" method="post" action="{{ route('admin.role.update' , ['role' => $role->id]) }}" enctype="multipart/form-data">
         @csrf
         @method('Put') 
         <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Name</label>  
             <div class="col-md-9 col-lg-6">
                <input name="name" id="name" type="text" value="{{ $role->name }}" class="form-control">								
             </div>
          </div>
          <div class="form-action">
             <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
          </div>
       </form>
       <!-- /form-->
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer')
 </div>
 <!-- /.content-wrapper -->
@endsection