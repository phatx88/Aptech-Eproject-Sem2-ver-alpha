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
             <a href="{{ route('admin.newsletter.index') }}">newsletter</a>
         </li>
         <li class="breadcrumb-item active">Add</li>
     </ol>
     @include('errors.error')
       <!-- /.row -->
       <!-- form -->
       <form method="post" action="{{ route('admin.newsletter.store') }}">
         @csrf


          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="price">Email</label>
             <div class="col-md-9 col-lg-6">
                <input name="email" id="price" type="text" min="0" class="form-control">
             </div>
          </div>
          <div class="form-action">
             <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
          </div>
       </form>
       <!-- /form -->
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
   @include('admin.footer')
 </div>
@endsection
