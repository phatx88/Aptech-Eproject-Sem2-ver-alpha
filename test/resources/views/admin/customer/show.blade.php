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
                <li class="breadcrumb-item active">Readonly</li>
            </ol>
            @include('errors.error')
            <!-- /form -->
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="fullname">Name</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="hidden" name="is_staff" value="0" class="form-control">
                        <input name="name" id="name" type="text" value="{{ $user->name }}" class="form-control" readonly>
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
                        <input name="mobile" id="mobile" type="text" value="{{ $user->mobile ?? "" }}" class="form-control" readonly>
                    </div>
                </div>
               
                <div class="form-group row">
                     <label class="col-md-12 control-label" for="housenumber_street">Address* :</label>
                    <div class="col-md-9 col-lg-6">
                        <span>{{ $user->housenumber_street ?? "" }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="housenumber_street">City* :</label>
                    <div class="col-md-9 col-lg-6">
                           <span>{{ $user->ward->name.' / ' ?? "" }}{{ $user->ward->district->name.' / ' ?? "" }}{{ $user->ward->district->province->name ?? "" }}</span>
                    </div>
                </div>

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
