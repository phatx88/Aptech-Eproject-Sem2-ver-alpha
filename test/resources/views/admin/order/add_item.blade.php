@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Đơn hàng</li>
       </ol>
       <!-- /.row -->
       <form class="spacing" method="post" action="" enctype="multipart/form-data">
           <div class="row">
               <div class="col-sm-12 ">
                   <label for="name" class="control-label">Order ID: #{{ $order->id }}</label>  
                   <input type="hidden" name="order_id" value="{{ $order->id }}">
               </div>
           </div>
           <div class="card mb-3">
                 <div class="card-body">
                    <div class="table-responsive">
                       <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                              <tr>
                                  <th><input type="checkbox" onclick="checkAll(this)"></th>
                                 <th>Mã sản phẩm</th>
                                 <th>Tên sản phẩm</th>
                                 <th>Hình ảnh</th>
                                 <th>Giá</th>
                                 <th>Số lượng</th>
                                 <th>Thành tiền</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($orderItem as $item)
                              <tr>
                                 <td><input type="checkbox"></td>
                                 <td >{{ $item->product_id }}</td>
                                 <td>{{ $products->find($item->product_id)->name }}</td>
                                 <td><img src="{{ asset('frontend/images/products/'.$products->find($item->product_id)->featured_image) }}"></td>
                                 <td>{{ $item->unit_price }}</td>
                                 <td><span>{{ $item->qty }}</span></td>
                                 <td><span>${{ $item->total_price }}</span></td>                                 
                              </tr>
                              @endforeach
                              
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
           
           <div class="form-action">
               <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="edit">
           </div>
           <br>
       </form>
       <!-- /.row -->
       <!-- /.row -->
       
      <!-- /.row -->
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
</div>
<!-- /#wrapper -->
@endsection