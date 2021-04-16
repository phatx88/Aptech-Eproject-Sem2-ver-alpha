@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Danh mục</li>
       </ol>
       <!-- DataTables Example -->
       <div class="action-bar">
          <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
          <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
       </div>
       <div class="card mb-3">
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                         <th><input type="checkbox" onclick="checkAll(this)"></th>
                         <th >BrandName</th>
                         <th></th>
                         <th></th>
                         <th></th>
                      </tr>
                   </thead>
                   <tbody>
                       @foreach ($brands as $brand)
                       <tr>
                        <td><input type="checkbox"></td>
                        <td >{{ $brand->name }}</td>
                        <td></td>
                        <td><a href="{{ route('admin.brand.edit', ['brand'=>$brand->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-warning btn-sm">Edit</a></td>
                        <td><a href="{{ route('admin.brand.destroy', ['brand'=>$brand->id]) }}" onclick="return confirm('Are you sure?')" class="btn btn-warning btn-sm">Delete</a></td>
                        {{-- <td ><input type="button" onclick="Delete('1');" value="Xóa" class="btn btn-danger btn-sm"></td> --}}
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
    <footer class="sticky-footer">
       <div class="container my-auto">
          <div class="copyright text-center my-auto">
             <span>Copyright © Thầy Lộc 2017</span>
          </div>
       </div>
    </footer>
 </div>
@endsection
