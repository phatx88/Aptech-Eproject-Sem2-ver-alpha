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
             <a href="{{ route('admin.permission.index') }}">Permission</a>
         </li>
         <li class="breadcrumb-item active">Edit</li>
     </ol>
     @include('errors.error')
       <!-- /form-->
       <form method="post" action="{{ route('admin.permission.update' , ['permission' => $permission->id]) }}">
           @csrf
           @method('Put')
          <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Permission Name</label>  
             <div class="col-md-9 col-lg-6">
                <input name="name" id="name" type="text" value="{{ $permission->name }}" class="form-control">								
             </div>
          </div>
          <div class="form-action">
            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
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