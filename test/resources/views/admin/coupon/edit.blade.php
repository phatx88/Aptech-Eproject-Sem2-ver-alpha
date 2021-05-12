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
            <a href="{{ route('admin.coupon.index') }}">Coupon</a>
         </li>
         <li class="breadcrumb-item active">Edit</li>
      </ol>
      @include('errors.error')
       <!-- /form -->
       <form method="post" action="{{ route('admin.coupon.update' , ['coupon' => $coupon->id]) }}" enctype="multipart/form-data">
         @csrf
         @method('Put')
         <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Coupon</label>
         </div>
         <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Name</label>
             <div class="col-md-9 col-lg-6">
                 <input name="name" id="name" type="text" value="{{ $coupon->name }}" class="form-control">
             </div>
         </div>
         <div class="form-group row">
             <label class="col-md-12 control-label" for="code">Code</label>
             <div class="col-md-9 col-lg-6">
                 <input name="code" id="code" type="text" value="{{ $coupon->code }}" class="form-control">
             </div>
         </div>
         <div class="form-group row">
             <label class="col-md-12 control-label" for="time">Time</label>
             <div class="col-md-9 col-lg-6">
                 <input name="time" id="time" type="number" value="{{ $coupon->time }}" class="form-control">
             </div>
         </div>
         <div class="form-group row">
             <label class="col-md-12 control-label" for="cpn_condition">Coupon Condition</label>
             <div class="col-md-9 col-lg-6">
                 <input name="cpn_condition" id="cpn_condition" type="number" value="{{ $coupon->cpn_condition }}" class="form-control">
             </div>
         </div>
         <div class="form-group row">
             <label class="col-md-12 control-label" for="number">Number</label>
             <div class="col-md-9 col-lg-6 ">
                 <input name="number" id="number" type="number" value="{{ $coupon->number }}" class="form-control">
             </div>
         </div>
         <div class="form-group row">

             <div class="col-md-9 col-lg-6">
                 <input type="submit" class="btn btn-primary btn-sm pull-right" value="Update" name="save">
             </div>
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
