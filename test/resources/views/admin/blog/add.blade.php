@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <form action="{{ route('admin.blog.store') }}" method="post" class="needs-validation"  novalidate enctype="multipart/form-data">
        @csrf
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard.index') }}">Admin</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('admin.blog.index') }}">Blog</a>
        </li>
        <li class="breadcrumb-item active">add</li>
       </ol>
       <!-- /form -->
        @if(session()->get('message'))
            <span class="alert alert-success">
                {{ session()->get('message') }}
            </span>
            @php
                session()->put('message', '');
            @endphp
        @endif

          <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Blog</label>
             <div class="col-md-9 col-lg-6">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="name">Tiêu Đề</label>
            <div class="col-md-9 col-lg-6">
                <input name="blog_title" id="blog_title" type="text" value="" class="form-control" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide a valid title.
                  </div>
           </div>
       </div>
       <div class="form-group row">
        <label class="col-md-12 control-label" for="name">Thẻ Tiêu Đề</label>
        <div class="col-md-9 col-lg-6">
            <input name="blog_meta_title" id="blog_meta_title" type="text" value="" class="form-control" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please provide a valid meta title.
            </div>
       </div>
    </div>
       <div class="form-group row">
        <label class="col-md-12 control-label" for="code">Summary</label>
        <div class="col-md-9 col-lg-6">
            <input name="summary_blog" id="summary_blog" type="text" value="" class="form-control" required>
            <div class="valid-feedback">
                Looks good!
            </div>
            <div class="invalid-feedback">
                Please provide a valid summary.
            </div>
       </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="time">Slug</label>
            <div class="col-md-9 col-lg-6">
                <input name="slug_blog" id="slug_blog" type="text" value="" class="form-control" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide a valid slug.
                </div>
           </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="time">Featured Image</label>
            <div class="col-md-9 col-lg-6">
                <input type="file" name="image" id="image" class="form-control" required>

                <div class="invalid-feedback">
                    Please choose featured image.
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 control-label" for="category">Category </label>
            <div class="col-md-9 col-lg-6 mb-2">
                <select name="category_id" id="category_select_blog" class="form-control " required>
                    <option value="">-- Select Category --</option>
                </select>
                <div class="valid-feedback">
                    Well!
                </div>
                <div class="invalid-feedback">
                    Please select Category.
                </div>
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
                {{-- <form action="">
                    @csrf --}}
                <select name="tags_id" id="tag_select_blog" class="form-control" required>
                    <option value="">-- Select Tag --</option>
                </select>
                <div class="valid-feedback">
                    Well!
                </div>
                <div class="invalid-feedback">
                    Please select Category.
                </div>
                <br>
                <input type="button" id="add-select-tag" value="Add Multiple Tag" class="form-control btn btn-primary ">
            {{-- </form> --}}
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
                    <textarea id="ckeditor1" name="blog_content" id="" rows="10" cols="80" required>
                </textarea>
                <div class="valid-feedback">
                    Well!
                </div>
                <div class="invalid-feedback">
                    Please select Category.
                </div>
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


       <!-- /form -->
    </div>
    </form>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->

    @include('admin.footer')

 </div>
 <!-- /.content-wrapper -->

 <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#add_category_blog').click(function(){
            var categoryInputBlog = $('#categoryInputBlog').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ url('/add-to-category-blog-by-input') }}',
                method: 'POST',
                data: {
                    categoryInputBlog:categoryInputBlog,
                    _token:_token
                },
                success: function(data){
                    notyf.success(data);
                    $('#categoryInputBlog').val('');
                    // window.setTimeout(function (){
                    //     location.reload();
                    // }, 2000);
                    show_list_categoy_blog();
                }
            });
        });
    })
    show_list_categoy_blog();
   function show_list_categoy_blog(){
    // $(document).ready(function() {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{ url('/show-list-category-blog') }}',
            method: 'POST',
            data: {
                _token:_token
            },
            success: function(data){
                $('#category_select_blog').html(data);
            }
        });

    // });
   }

    $(document).ready(function() {
        $('#add_tag_blog').click(function(){
            var tagInput = $('#tagInput').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ url('/add-to-tag-blog-by-input') }}',
                method: 'POST',
                data: {
                    tagInput:tagInput,
                    _token:_token
                },
                success: function(data){
                    notyf.success(data);
                    // window.setTimeout(function (){
                    //     location.reload();
                    // }, 1000);
                    $('#tagInput').val('')
                    show_list_tag();
                }
            });
        });
    });
    show_list_tag();

    function show_list_tag(){
        // $(document).ready(function() {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{ url('/show-list-tag-blog') }}',
            method: 'POST',
            data: {
                _token:_token
            },
            success: function(data){
                $('#tag_select_blog').html(data);
            }
        });

    // });
    }

    $(document).ready(function() {
        $('#add-select-tag').click(function(){
            var id = $('#tag_select_blog').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ url('/add-tag') }}',
                method: 'POST',
                data: {
                _token:_token,
                id
                },
                success: function(data){
                $('#tag-list').append(data);
            }
            });
        });
    });

    $(document).ready(function() {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{ url('/show-tag-blog') }}',
            method: 'POST',
            data: {
                _token:_token
            },
            success: function(data){
                $('#tag-list').html(data);
            }
        });

    });

    $(document).ready(function() {
        $('#list-of-tags').on('click','.delete-tag-input', function(){
            var _token = $('input[name="_token"]').val();
            var id = $(this).data('id_tag_delete');
            $.ajax({
                url: '{{ url('/delete-tag-blog') }}',
                method: 'POST',
                data: {
                    _token:_token,
                    id:id
                },
                success: function(data){
                notyf.error('Tag Deleted');
                }
            });
        });
    });

</script>
@endsection
