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
                    <a href="{{ route('admin.staff.index') }}">Staff</a>
                </li>
                <li class="breadcrumb-item active">Register</li>
            </ol>
            @include('errors.error')
            <!-- /form -->
            <form method="POST" action="{{ route('admin.staff.store') }}" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="is_staff" value="1">
                <div class="form-group row">
                   <label class="col-md-12 control-label" for="fullname">Fullname</label>  
                   <div class="col-md-9 col-lg-6">
                      <input type="hidden" name="id" value="1" class="form-control input-md">
                      <input name="name" id="fullname" type="text" value="" class="form-control">                        
                   </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-12 control-label" for="email">Email</label>  
                  <div class="col-md-9 col-lg-6">                           
                     <input name="email" id="email" type="text" value="" class="form-control">                      
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-12 control-label" for="role">Roles</label>  
                  <div class="col-md-9 col-lg-6">
                     <select name="role" class="form-control">
                        <option value="Inspector">Inspector</option>
                        <option value="Staff">Staff</option>
                     </select>
                  </div>
               </div>
                <div class="form-group row">
                   <label class="col-md-12 control-label" for="password">Password</label>  
                   <div class="col-md-9 col-lg-6">                           
                      <input name="password" id="password" type="password" value="" class="form-control">                      
                   </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-12 control-label" for="confirm-password">confirm Password</label>  
                  <div class="col-md-9 col-lg-6">                           
                     <input name="confirm-password" id="confirm-password" type="password" value="" class="form-control">                      
                  </div>
               </div>        
                
        </div>
        <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Register" name="save">
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
