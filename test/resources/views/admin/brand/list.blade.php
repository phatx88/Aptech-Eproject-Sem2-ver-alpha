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
             <a href="{{ route('admin.brand.index') }}">Brand</a>
         </li>
         <li class="breadcrumb-item active">List</li>
     </ol>
       <!-- DataTables Example -->
       @include('errors.message')
       <div class="card mb-3">
         <div class="card-header">
            <i class="fas fa-table"></i>
            Brand
            @can('create', 'App\Models\Product')
            <a href="{{ route('admin.brand.create')}}" class="btn btn-primary btn-sm float-right">Add</a>
            @endcan
         </div>
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                         {{-- <th><input type="checkbox" onclick="checkAll(this)"></th> --}}
                         <th></th>
                         <th >BrandName</th>
                         <th></th>
                         <th>Action</th>
                         <th></th>
                      </tr>
                   </thead>
                   <tbody>
                       @foreach ($brands as $brand)
                    <tr>
                        {{-- <td><input type="checkbox"></td> --}}
                        <td >{{ $brand->id }}</td>
                        <td >{{ $brand->name }}</td>
                        <td></td>
                        <td>
                           @can('update', 'App\Models\Product')
                           <a href="{{ route('admin.brand.edit', ['brand'=>$brand->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                           @endcan
                        </td>
                        <form action="{{ route('admin.brand.destroy', ['brand'=>$brand->id]) }}" method="POST">
                            @csrf @method('delete')
                            <td>
                              @can('delete', 'App\Models\Product') 
                              <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                              @endcan
                           </td>
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
