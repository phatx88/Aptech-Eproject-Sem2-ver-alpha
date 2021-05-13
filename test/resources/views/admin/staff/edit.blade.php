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
                @if (Auth::user()->email == 'phat.x.luong@gmail.com')
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="job_title">Job Title</label>  
                    <div class="col-md-9 col-lg-6">   
                        @if (Auth::user()->id == $staff_user->id) 
                        <input name="" id="job_title" type="text" value="{{ $staff_user->staff->job_title }}" class="form-control-plaintext" readonly>                      
                        @else
                        <input name="job_title" id="job_title" type="text" value="{{ $staff_user->staff->job_title }}" class="form-control" required>
                        @endif                        
                    </div>
                 </div>
                @endif
                
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
               
                @if (Auth::user()->email == 'phat.x.luong@gmail.com')
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="role">Roles</label>
                    <div class="col-md-9 col-lg-6">
                        @if (Auth::user()->id == $staff_user->id) 
                        <input type="text" value="1 - admin" class="form-control-plaintext" readonly>
                        @else
                        <select name="role" class="form-control" >
                            <option value="">Select Roles</option>
                            @foreach ($staff_roles as $role)
                            <option value="{{ $role->id }}" {{ $staff_user->staff->role_id == $role->id ? 'selected' : '' }}>{{ $role->id }} - {{ $role->name }}</option>
                            @endforeach
                         </select>
                        @endif
                        
                    </div>
                </div>
                @endif
                
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
            <input type="submit" class="btn btn-primary btn-sm" value="Update">
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
