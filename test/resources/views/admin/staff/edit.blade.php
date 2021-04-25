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
            @include('errors.error')
            <form method="POST" action="{{ route('admin.staff.update' , ['staff' => $staff_user->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="fullname">Fullname</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="hidden" name="is_staff" value="1" class="form-control input-md">
                        <input name="name" id="fullname" type="text" value="{{ $staff_user->name }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="email">Email</label>
                    <div class="col-md-9 col-lg-6">
                        <input id="email" type="text" value="{{ $staff_user->email }}" class="form-control-plaintext" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="mobile">Mobile</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="mobile" id="mobile" type="text" value="{{ $staff_user->mobile }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="role">Roles</label>
                    <div class="col-md-9 col-lg-6">
                        <select name="role" class="form-control">
                            <option value="" {{ $staff_user->staff->role == "Admin" ? "Selected" : "" }}></option>
                            <option value="Inspector" {{ $staff_user->staff->role == "Inspector" ? "Selected" : "" }}>Inspector</option>
                            <option value="Staff" {{ $staff_user->staff->role == "Staff" ? "Selected" : "" }}>Staff</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <label class="col-md-12 control-label" for="address">Address</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="housenumber_street" id="address" type="text" value="{{ $staff_user->housenumber_street }}" class="form-control">
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-md-2">
                        <select class="form-control choose province" name="province" id="province">
                            @if ($staff_user->ward != null)
                            <option value="{{ $staff_user->ward->district->province->id }}">{{ $staff_user->ward->district->province->name }}</option>
                            @else
                            <option value="">--Chọn Thành phố---</option>
                            @endif
                            @foreach ($provinces as $key => $pvin)
                                <option value="{{ $pvin->id }}">
                                    {{ str_replace(['Thành phố', 'Tỉnh'], '', $pvin->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control choose district" name="district" id="district">
                            @if ($staff_user->ward != null)
                            <option value="{{ $staff_user->ward->district->id }}">{{ $staff_user->ward->district->name }}</option>
                            @else
                            <option value="">--Chọn quận huyện---</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control ward check-shipping-fee" name="ward_id" id="ward">
                            @if ($staff_user->ward != null)
                            <option value="{{ $staff_user->ward_id }}">{{ $staff_user->ward->name }}</option>
                            @else
                            <option value="">--Chọn xã phường---</option>
                            @endif
                        </select>
                    </div>
                </div>

        </div>
        <div class="form-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Submit">
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
