@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
            <div class="container-fluid">
               <!-- Breadcrumbs-->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="#">Quản lý</a>
                  </li>
                  <li class="breadcrumb-item active">Sản phẩm</li>
               </ol>
               <!-- DataTables Example -->
               <div class="action-bar">
                  <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">Add</a>
                  <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
               </div>
               <div class="card mb-3">
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                              <tr>
                                 <th><input type="checkbox" onclick="checkAll(this)"></th>
                                 <th>ID</th>
                                 <th style="width:50px">Name </th>
								         <th>Featured Image</th>
                                 <th>Price</th>
                                 <th>% Discount</th>
                                 <th>Discout Date From</th>
                                 <th>Discout Date To</th>
                                 <th>Sale Price</th>
                                 <th>Quantity</th>
                                 <th>Category</th>
                                 <th>Brand</th>
                                 <th>Description</th>
                                 <th>Created Date</th>
                                 <th>Featured</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody style="text-overflow: ellipsis">
                              @foreach ($products as $product)
                              <tr style="text-overflow: ellipsis">
                                 <td><input type="checkbox"></td>
                                 <td>{{ $product->id }}</td>
                                 <td>{{ $product->name }}</td>
                                 <td><img src="{{ asset('frontend/images/products/'.$product->featured_image) }}"></td>
                                 <td>${{ $product->price }}</td>
                                 <td>{{ $product->discount_percentage == 0 ? 'N/A' : $product->discount_percentage.'%'}}</td>
                                 <td>{{ $product->discount_from_date == 0 ? 'N/A': $product->discount_from_date }}</td>
                                 <td>{{ $product->discount_to_date == 0 ? 'N/A': $product->discount_to_date }}</td>
                                 <td>${{ round($product->price * (100 - $product->discount_percentage) /100 , 2) }}</td>
                                 <td>{{ $product->inventory_qty }}</td>
                                 <td>{{ $product->category->name }}</td>
                                 <td>{{ $product->brand->name }}</td>
                                 <td><a href="">Show</a></td>
                                 <td></td>
                                 <td></td>
                                 <td><a href="../../pages/comment/list.html">Đánh giá</a></td>
                                 <td><a href="../../pages/image/list.html">Hình ảnh</a></td>
                                 <td><a href="{{ route('admin.product.edit' , ['product' => $product->id]) }}"  class="btn btn-warning btn-sm">Edit</a></td>
                                 <td><input type="button" onclick="Delete('25');" value="Xóa" class="btn btn-danger btn-sm"></td>
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
         <!-- /.content-wrapper -->
@endsection