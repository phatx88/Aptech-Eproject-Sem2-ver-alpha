@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Create New Blog</li>
       </ol>
       <!-- /form -->
       <form method="post" action="{{ route('admin.coupon.store') }}" enctype="multipart/form-data">
        @csrf

          <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Blog</label>
             <div class="col-md-9 col-lg-6">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="name">Tiêu Đề</label>
            <div class="col-md-9 col-lg-6">
                <input name="name" id="name" type="text" value="" class="form-control">
           </div>
       </div>
       <div class="form-group row">
        <label class="col-md-12 control-label" for="code">Summary</label>
        <div class="col-md-9 col-lg-6">
            <input name="code" id="code" type="text" value="" class="form-control">
       </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="time">Slug</label>
            <div class="col-md-9 col-lg-6">
                <input name="" id="time" type="text" value="" class="form-control">
           </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="time">Category </label>
            <div class="col-md-9 col-lg-6">
                <input name="" id="time" type="text" value="" class="form-control">
           </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="time">Tag</label>
            <div class="col-md-9 col-lg-6">
                <input name="" id="time" type="text" value="" class="form-control">
           </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="cpn_condition">Content</label>
                <div class="col-md-9 col-lg-6">
                    <textarea id="ckeditor1" name="" id="" cols="30" rows="10"></textarea>
               </div>
        </div>
                <div class="form-group row">
                    {{-- <label class="col-md-12 control-label" for="number">Number</label> --}}
                    {{-- <div class="col-md-9 col-lg-6 ">
                        <input name="number" id="number" type="number" value="" class="form-control">
                   </div> --}}
                    </div>
                    <div class="form-group row">

                        <div class="col-md-9 col-lg-6">
                            <input type="submit" class="btn btn-primary btn-sm pull-right"  value="Lưu" name="save">
                       </div>
                   </div>

       </form>
       <!-- /form -->
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    <footer class="sticky-footer">
       <div class="container my-auto">
          <div class="copyright text-center my-auto">
             <span>Copyright © Thầy Lộc 2017</span>
          </div>
       </div>
    </footer>
 </div>
 <!-- /.content-wrapper -->
@endsection
