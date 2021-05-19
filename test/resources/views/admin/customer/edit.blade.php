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
                    <a href="{{ route('admin.user.index') }}">User</a>
                </li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
            @include('errors.error')
            <!-- /form -->
            <form method="post" action="{{ route('admin.user.update' , ['user' => $user->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="fullname">Name</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="hidden" name="is_staff" value="0" class="form-control">
                        <input name="name" id="name" type="text" value="{{ $user->name }}" class="form-control" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="email">Email</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="" id="email" type="text" value="{{ $user->email }}" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="mobile">Mobile</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="mobile" id="mobile" type="text" value="{{ $user->mobile ?? "" }}" class="form-control">
                    </div>
                </div>
               
                <div class="form-group row">
                     <label class="col-md-12 control-label" for="housenumber_street">Address* :</label>
                    <div class="col-md-9 col-lg-6">
                            <input type="text" name="housenumber_street" value="{{ $user->housenumber_street ?? "" }}"
                                placeholder="Enter House Street Number" class="form-control" >
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <select class="form-control choose province" name="province" id="province" >
                           @if ($user->ward->district != null)
                           <option value="{{ $user->ward->district->province }}">
                               {{ $user->ward->district->province->name }}</option>
                           @else
                                 <option value="">--Chọn Thành phố---</option>
                           @endif
                            @foreach ($provinces as $key => $pvin)
                                <option value="{{ $pvin->id }}">
                                    {{ str_replace(['Thành phố', 'Tỉnh'], '', $pvin->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control choose district" name="district" id="district" >
                           @if ($user->ward->district != null)
                           <option value="{{ $user->ward->district }}">
                               {{ $user->ward->district->name }}</option>
                           @else
                                 <option value="">--Chọn quận huyện---</option>
                           @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control ward" name="ward_id" id="ward" >
                           @if ($user->ward_id != null)
                           <option value="{{ $user->shipping_ward_id }}">{{ $user->ward->name }}
                           </option>
                           @else
                                 <option value="">--Chọn xã phường---</option>
                           @endif
                        </select>
                    </div>
                </div>


                <div class="form-action">
                    <input type="submit" class="btn btn-primary btn-sm" value="Edit" name="update">
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
