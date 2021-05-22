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
            <a href="{{ route('admin.coupon.index') }}">Coupon</a>
         </li>
         <li class="breadcrumb-item active">List</li>
      </ol>
      @include('errors.message')
       <!-- DataTables Example -->
       <div class="card mb-3">
         <div class="card-header">
            <i class="fas fa-users"></i>
            Coupon List
            <div class="float-right">
               <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary btn-sm text-white">Add </a>
               <a href="{{ route('admin.coupon.export') }}"><input type="button" class="btn btn-success btn-sm" value="Export" name="export"></a>
            </div>
        </div>
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>

                         <th>
                             Id
                         </th>
                         <th>
                           Name
                         </th>
                         <th>
                            Code
                        </th>
                        <th>
                            Time
                        </th>
                        <th>
                            Cpn_condition
                        </th>
                        <th>
                            Number
                        </th>
                        <th>Action</th>
                        <th></th>
                      </tr>
                   </thead>
                   <tbody>
                       @foreach ($coupons as $coupon)
                       <tr>
                        <td >{{ $coupon->id }}</td>
                        <td >{{ $coupon->name }}</td>
                        <td >{{ $coupon->code }}</td>
                        <td >{{ $coupon->time }}</td>
                        <td >{{ $coupon->cpn_condition }}</td>
                        <td >{{ $coupon->number }}</td>
                        <td><a href="{{ route('admin.coupon.edit', ['coupon'=>$coupon->id]) }}" class="btn btn-warning btn-sm">Edit</a></td>
                        <form action="{{ route('admin.coupon.destroy', ['coupon'=>$coupon->id]) }}" method="POST">
                            @csrf @method('delete')
                            <td><button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button></td>
                        </form>
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
