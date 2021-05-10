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
             <a href="{{ route('admin.brand.index') }}">Brand</a>
         </li>
         <li class="breadcrumb-item active">Edit</li>
     </ol>
       <!-- /form -->
       <form method="post" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="form-group row">
             <label class="col-md-12 control-label" for="name">BrandName</label>
             <div class="col-md-9 col-lg-6">
                <input name="brand_name" id="name" type="text" value="" class="form-control">
             </div>
          </div>
          <div class="form-action">
             <input type="submit" class="btn btn-primary btn-sm" value="Add" name="save">
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
