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
                <li class="breadcrumb-item active">List</li>
            </ol>
            @include('errors.message')
            <!-- DataTables Example -->
            <div class="action-bar">
                <a href="{{ route('admin.staff.create') }}" class="btn btn-primary btn-sm" >Add Employee</a>
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>Name </th>
                                    <th>Address </th>
                                    <th>Email </th>
                                    <th>Mobile </th>
                                    <th>Role </th>
                                    <th>Active </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staff_users as $user)
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->housenumber_street ?? "" }} , {{ $user->ward->name ?? "" }} , {{ $user->ward->district->name ?? "" }} , {{ $user->ward->district->province->name ?? "" }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->mobile  ?? ""}}</td>
                                        <td>{{ $user->staff->role }}</td>
                                        <td>{{ $user->is_active == true ? "Yes" : "No" }}</td>
                                        <td> <a type="button" href="{{ route('admin.staff.edit' , ['staff' => $user->id]) }}"
                                                class="btn btn-warning btn-sm">Edit</a></td>
                                        <td><input type="button" onclick="Delete('1');" value="Xóa"
                                                class="btn btn-danger btn-sm"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        @include('admin.footer')
    </div>
@endsection
