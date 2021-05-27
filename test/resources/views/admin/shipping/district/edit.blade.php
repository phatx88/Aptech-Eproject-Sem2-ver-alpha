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
             <a href="{{ route('admin.district.index') }}">District</a>
         </li>
         <li class="breadcrumb-item active">Edit</li>
     </ol>
     @include('errors.error')
       <!-- /.row -->
       <!-- form -->
       <form method="post" action="{{ route('admin.district.update' , ['district' => $district->id]) }}" enctype="multipart/form-data">
         @csrf
         @method('put')
          <div class="form-group">
             <label class="col-md-12 control-label" for="name">Ward Type</label>
             <div class="col-md-9 col-lg-6">
               <select name="" class="form-control province" readonly oninvalid="this.setCustomValidity('Please Choose a Valid Province/Cities')">
                  <option value="{{ $district->id }}">{{ $district->name }}</option>
          </select>
             </div>
          </div>
          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="name">District Name</label>
             <div class="col-md-9 col-lg-6">
                <input name="name" id="name" type="text" min="0" value="{{ $district->name }}" class="form-control" required>
             </div>
          </div>
          <div class="form-group">
            <label class="col-md-9 col-lg-6 control-label" for="district_id">Province ID</label>
            <div class="col-md-9 col-lg-6">
               <input id="province_id" type="number" min="0" value="{{ $district->province_id }}" class="form-control" readonly >
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
