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
                <li class="breadcrumb-item active">Add</li>
            </ol>
            @include('errors.error')
            <!-- /form -->
            <form method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="fullname">Name</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="hidden" name="is_staff" value="0" class="form-control">
                        <input name="name" id="name" type="text" value="{{ old('name') }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="email">Email</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="email" id="email" type="text" value="{{ old('email') }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="mobile">Mobile</label>
                    <div class="col-md-9 col-lg-6">
                        <input name="mobile" id="mobile" type="text" value="{{ old('mobile') }}" class="form-control">
                    </div>
                </div>
               
                <div class="form-group row">
                     <label class="col-md-12 control-label" for="housenumber_street">Address* :</label>
                    <div class="col-md-9 col-lg-6">
                            <input type="text" name="housenumber_street" value="{{ old('housenumber_street') }}"
                                placeholder="Enter House Street Number" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <select class="form-control choose province" name="province" id="province" required>
                            <option value="">--Chọn Thành phố---</option>
                            @foreach ($provinces as $key => $pvin)
                                <option value="{{ $pvin->id }}">
                                    {{ str_replace(['Thành phố', 'Tỉnh'], '', $pvin->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control choose district" name="district" id="district" required>
                            <option value="">--Chọn quận huyện---</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select class="form-control ward" name="ward_id" id="ward" required>
                            <option value="">--Chọn xã phường---</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-12 control-label" for="password">Password</label>
                  <div class="col-md-9 col-lg-6">
                      <input name="password" id="password" type="password" value="" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-md-12 control-label" for="confirm-password">Confirm Password</label>
                  <div class="col-md-9 col-lg-6">
                      <input name="confirm-password" id="confirm-password" type="password" value="" class="form-control"
                          required>
                  </div>
              </div>

                <div class="form-action">
                    <input type="submit" class="btn btn-primary btn-sm" value="Submit" name="update">
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
