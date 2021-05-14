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

         </li>
         <li class="breadcrumb-item active">Edit</li>
     </ol>
     @include('errors.error')
       <!-- /.row -->
       <!-- form -->
       <form method="post" action="{{ URL('admin/ImageItem/update/'.$product_id.'/'.$ImageItems->id) }}" enctype="multipart/form-data">
         @csrf

          <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Image</label>

             <div class="col-md-12">
                <input type="file" name="image" id="image" class="form-control">
                <input type="hidden" name="product_id" value="{{ $product_id }}" class="form-control">
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
 <!-- /.content-wrapper -->
@endsection
