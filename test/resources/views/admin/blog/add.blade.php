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
            <label class="col-md-12 control-label" for="time">Featured Image</label>
            <div class="col-md-9 col-lg-6">
                <input type="file" name="featured_image" id="image">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="category">Category </label>
            <div class="col-md-9 col-lg-6 mb-2">
                <select name="category_id" id="category_select_blog" class="form-control " required>
                    <option value="">-- Select Category --</option>
                </select>
            </div>
            <div class="col-md-3 col-lg-2">
                <form action="">
                    @csrf
                <div class="input-group">
                        <input type="text" name="category_name" id="categoryInputBlog" class="form-control"
                            data-url="">
                        <button class="btn btn-primary input-group-prepend" type="button" id="add_category_blog">Add</button>
                </div>
            </form>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-12 control-label" for="tag">Tag </label>
            <div class="col-md-9 col-lg-6 mb-2">
                <form action="">
                <select name="tag_id" id="tag_select_blog" class="form-control" required>
                    <option value="">-- Select Tag --</option>
                </select>
                <br>
                <input type="button" id="add-select-tag" value="Add Tag" class="form-control btn btn-primary ">
            </form>
            </div>
            <div class="col-md-3 col-lg-2">
                <form action="">
                    @csrf
                <div class="input-group">
                    <input type="text" name="name" id="tagInput" class="form-control"
                        data-url="">
                    <button class="btn btn-primary input-group-prepend" type="button" id="add_tag_blog">Add</button>
                </div>
            </form>
            </div>
        </div>
        <div class="form-group row" id="list-of-tags">
                <ul class="list-group" id="tag-list">
                    {{-- <tr class="alert list-group"  id="tag-list">

                    </tr> --}}
                </ul>

       </div>
        <hr>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="cpn_condition">Content</label>
                <div class="col-md-12">
                    <textarea id="ckeditor1" name="" id="" rows="10" cols="80"></textarea>
               </div>
        </div>
                {{-- <div class="form-group row">
                    {{-- <label class="col-md-12 control-label" for="number">Number</label> --}}
                    {{-- <div class="col-md-9 col-lg-6 ">
                        <input name="number" id="number" type="number" value="" class="form-control">
                   </div> --}}
                    {{-- </div> --}}
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
    @include('admin.footer')
 </div>
 <!-- /.content-wrapper -->
@endsection
