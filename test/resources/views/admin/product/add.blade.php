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
                  <a href="{{ route('admin.product.index') }}">Product</a>
              </li>
                <li class="breadcrumb-item active">Add Product</li>
            </ol>
            <!-- /form -->
            @include('errors.error')
            <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="barcode">Barcode (Optional)</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="barcode" id="barcode" type="text" value="{{ old('barcode') }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="sku">Sku (Optional)</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="sku" id="sku" type="text" value="{{ old('sku') }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">Name </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="product_name" id="name" type="text" value="{{ old('product_name') }}" class="form-control @error('product_name') is-invalid @enderror" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="wholesale-price">Price </label>
                    <div class="col-md-9 col-lg-6">
                        <input name="price" id="wholesale-price" type="number" min="0" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="inventory-number">Inventory</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="inventory_qty" id="inventory-number" type="number" min="0" value="{{ old('inventory_qty') }}" class="form-control @error('inventory_qty') is-invalid @enderror" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="category">Category </label>
                    <div class="col-md-9 col-lg-6 mb-2">
                        <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? "selected" : "" }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <div class="input-group">
                            <input type="text" name="category_name" id="categoryInput" class="form-control"
                                data-url="{{ route('admin.category.store') }}">
                            <button class="btn btn-primary input-group-prepend" type="button" id="add_category">Add</button>
                            <span class="invalid-feedback" role="alert" id="categoryError">
                                <strong></strong>
                            </span>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="brand">Brand </label>
                    <div class="col-md-9 col-lg-6 mb-2">
                        <select name="brand_id" id="brand" class="form-control @error('brand_id') is-invalid @enderror" required>
                            <option value="">-- Select Brand --</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == old('brand_id') ? "selected" : "" }} >{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 col-lg-2">
                        <div class="input-group">
                            <input type="text" name="name" id="brandInput" class="form-control"
                                data-url="{{ route('admin.brand.store') }}">
                            <button class="btn btn-primary input-group-prepend" type="button" id="add_brand">Add</button>
                            <span class="invalid-feedback" role="alert" id="brandError">
                                <strong></strong>
                            </span>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="discount_percentage">Discount (Percentage)</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="discount_percentage" id="discount_percentage" type="number" value="{{ old('discount_percentage') }}"
                            class="form-control @error('brand_id') is-invalid @enderror">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="discount_from_date">Promotion From</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="discount_from_date" id="discount_from_date" type="date" value="{{ old('discount_from_date') }}" class="form-control @error('discount_from_date') is-invalid @enderror">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label" for="discount_to_date">Promotion To</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="discount_to_date" id="discount_to_date" type="date" value="{{ old('discount_to_date') }}" class="form-control @error('discount_to_date') is-invalid @enderror">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-12 control-label">Featured</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="checkbox" value="1" name="featured" {{ old('featured') == 1 ? 'checked' : '' }}>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="image">Featured Images </label>
                    <div class="col-md-9 col-lg-6">
                        <input type="file" name="featured_image" id="image">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="description">Description</label>
                    <div class="col-md-12">
                        <textarea name="description" id="description" rows="10" cols="80" value=""></textarea>
                    </div>

                </div>
                <div class="form-action">
                    <input type="submit" class="btn btn-primary btn-sm" name="save">
                </div>
            </form>
        <!-- /form -->
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        @include('admin.footer')
    </div>
    <!-- /.content-wrapper -->
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('backend/vendor/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description');
    $('#description').html('{{ old('description') }}');
</script>
<script>
    $(document).ready(function() {
        $("#add_category").click(function(e) {
            e.preventDefault();
            var name = $('#categoryInput').val();
            var url = $('#categoryInput').data('url');
            var _token = $('input[name=_token]').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: _token,
                    name: name,
                },
                success: function(response) {
                    notyf.success('Success: Added new category');
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                },
                error: (response) => {
                    if (response.status === 422) {
                        notyf.error('Error: Failed to add new category');
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            $("#categoryInput").addClass("is-invalid");
                            $("#categoryError").children("strong").text(
                                errors[key][0]);
                        });
                    } else {
                        notyf.error('Error: Failed to add new category');
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    }
                }
            });
        });

        $('#add_brand').click(function(e) {
            e.preventDefault();
            var name = $('#brandInput').val();
            var url = $('#brandInput').data('url');
            var _token = $('input[name=_token]').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: _token,
                    name: name,
                },
                success: function(response) {
                    notyf.success('Success: Added new brand');
                    setTimeout(function() {
                        window.location.reload();
                    }, 3000);
                },
                error: (response) => {
                    if (response.status === 422) {
                        notyf.error('Error: Failed to add new brand');
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            $("#brandInput").addClass("is-invalid");
                            $("#brandError").children("strong").text(
                                errors[key][0]);
                        });
                    } else {
                        notyf.error('Error: Failed to add new brand');
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    }
                }
            });
        });
    });

</script>
@endsection
