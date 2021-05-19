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
       <form method="post" action="{{ route('admin.brand.update' , ['brand' => $brand->id]) }}" enctype="multipart/form-data">
         @csrf
         @method('PUT') 
          <div class="form-group row">
             <label class="col-md-12 control-label" for="name">BrandName</label>
             <div class="col-md-9 col-lg-6">
                {{-- <input type="hidden" name="id" value="1" class="form-control"> --}}
                <input name="name" id="name" type="text" value="{{ $brand->name }}" class="form-control">
             </div>
          </div>
          <div class="form-action">
             <input type="submit" class="btn btn-primary btn-sm" value="Edit" name="update">
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
