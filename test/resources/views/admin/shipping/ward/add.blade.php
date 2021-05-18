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
             <a href="{{ route('admin.ward.index') }}">Ward</a>
         </li>
         <li class="breadcrumb-item active">Add</li>
     </ol>
     @include('errors.error')
       <!-- /.row -->
       <!-- form -->
       <form method="post" action="{{ route('admin.ward.store') }}" enctype="multipart/form-data">
         @csrf

          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="name">Ward Name</label>
             <div class="col-md-9 col-lg-6">
                <input name="name" id="price" type="text" min="0" class="form-control"  required>
             </div>
          </div>
          <div class="form-group">
              <label class="col-md-9 col-lg-6 control-label" for="price">Ward Type</label>
              <div class="col-md-9 col-lg-6">
                  <input name="" id="price" type="text" min="0" class="form-control"  required>
                </div>
            </div>
            <div class="form-group ">
              <label class="col-md-9 control-label" for="District_id">District Id</label>
              <div class="col-md-9 col-lg-6">
                 <select name="District_id" class="form-control province" required="" oninvalid="this.setCustomValidity('Please Choose a District ')">
                     <option value="">District</option>
                     @foreach ($districts as $district)
                     <option value="{{ $district->id }}">{{ $district->name }}</option>
                     @endforeach

             </select>
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
