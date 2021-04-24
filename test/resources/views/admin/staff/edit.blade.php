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
                    <a href="{{ route('admin.staff.index') }}">Staff</a>
                </li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
            <form method="post" action="" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="fullname">Fullname</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="hidden" name="id" value="1" class="form-control input-md">
                        <input name="name" id="fullname" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="email">Email</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="email" id="email" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="mobile">Mobile</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="mobile" id="mobile" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="password">Password</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="password" id="password" type="password" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="confirm-password">confirm Password</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="confirm-password" id="confirm-password" type="password" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="role">Roles</label>
                    <div class="col-md-9 col-lg-6">
                        <select name="role" class="form-control">
                            <option value="Inspector">Inspector</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-md-12 control-label" for="address">Address</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="housenumber_street" id="address" type="text" value="" class="form-control">
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-2">
                        <select class="form-control choose province" name="province" id="province">
                            <option value="">--Chọn Thành phố---</option>
                            @foreach ($provinces as $key => $pvin)
                                <option value="{{ $pvin->id }}">
                                    {{ str_replace(['Thành phố', 'Tỉnh'], '', $pvin->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control choose district" name="district" id="district">
                            <option value="">--Chọn quận huyện---</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control ward check-shipping-fee" name="ward_id" id="ward">
                            <option value="">--Chọn xã phường---</option>
                        </select>
                    </div>
                </div>

        </div>
        <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Register" name="save">
        </div>
        </form>
        <!-- /form -->
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer')
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                // alert(ma_id);
                if (action == 'province') {
                    result = 'district';
                } else if (action == 'district') {
                    result = 'ward';
                }
                $.ajax({
                    url: '{{ url('select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        // alert (result);
                        $('#' + result).html(data);
                    }
                });
            });
        });

    </script>
@endsection
