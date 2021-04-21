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
                   <label for="name" class="control-label">Đơn hàng: #112</label>  
                   <input type="hidden" name="id" value="112">
               </div>
           </div>
           <div class="row ">
               <div class="col-sm-4 col-lg-2">
                   <label>Tên khách hàng:</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <span>{{ $order->user->name ?? "Guest" }}</span>							
               </div>
           </div>
           
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Email:</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <span>{{ $order->user->email ?? $order->shipping_email }}</span>
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Trạng thái:</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <select name="status" class="form-control">  
                       @foreach ($statuses as $status)
                       <option value="{{ $status->id }}" {{ $status->id == $order->status->id ? 'selected' : '' }}>{{ $status->name }}</option>   
                       @endforeach 
                     </select>
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Ngày đặt hàng:</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <span>{{ $order->created_date }}</span>							
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Người nhận</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <input type="text" name="" value="{{ $order->shipping_fullname }}" class="form-control"> 							
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Số điện thoại người nhận</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <input type="text" name="mobile" value="{{ $order->shipping_mobile }}" class="form-control"> 							
               </div>
           </div>
           
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Hình thức thanh toán</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <select name="transport" class="form-control">
                        <option {{ $order->payment_method == 0 ? 'selected' : '' }} value="0">COD</option>
                        <option {{ $order->payment_method == 1 ? 'selected' : '' }} value="1">Bank</option>
                     </select>
               </div>
           </div>
           
           
           
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Tạm tính:</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <span>$
                        @php
                            $sum = 0;
                            $coupon = 0;
                            $total = 0;
                            foreach ($orderItem as $item) {
                                $sum += $item->total_price;
                            }
                            echo $sum;   
                        @endphp
                    </span>							
               </div>
           </div>
           
           
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Shipping Fee:</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   $ <input type="number" value="50000"> 						
               </div>
           </div>

           <div class="row">
            <div class="col-sm-4 col-lg-2 ">
                <label>Coupon Discount:</label>  
            </div>
            <div class="col-sm-8 col-lg-6"> 
                $ <input type="number" value="{{ $counpon = $order->coupon->number ?? ""}}">					
            </div>
        </div>

           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Tổng cộng:</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <span>$ {{ $total = $sum + $order->shipping_fee - $coupon }}</span>							
               </div>
           </div>
           <div class="row">
               <div class="col-sm-4 col-lg-2">
                   <label>Địa chỉ giao hàng</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <div class="row">
                       <div class="col-sm-4">
                           <select name="city" class="form-control">
                              <option value="">Tỉnh / thành phố</option>
                              <option value="hcm">Hồ Chí Minh</option>
                              <option value="hn">Hà Nội</option>
                          </select>
                        </div>
                       <div class="col-sm-4">
                           <select name="district" class="form-control">
                               <option value="">Quận / huyện</option>
                               <option value="q1">Quận 1</option>
                               <option value="q2">Quận 2</option>
                           </select>
                       </div>
                       <div class="col-sm-4">
                           <select name="ward" class="form-control">
                               <option value="">Phường / xã</option>
                               <option value="p1">Phường 1</option>
                               <option value="p2">Phường 2</option>
                           </select>
                       </div>
                   </div>							
               </div>
               
           </div>

           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Ngày giao hàng</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <input type="date" name="" value="{{ $order->delivered_date ?? "" }}" class="form-control">
               </div>
           </div>
           
           <div class="row">
               <div class="col-sm-4 col-lg-2 ">
                   <label>Nhân viên phụ trách</label>  
               </div>
               <div class="col-sm-8 col-lg-6"> 
                   <select name="staff" class="form-control">
                       <option value=""></option>
                       @foreach ($staffs as $staff)
                            <option {{ $staff->id === $order->staff_id ? "selected" : "" }} value="{{ $staff->id }}">{{ $staff->name }}</option>                   
                       @endforeach
                 </select>						
               </div>
           </div>

           <label class="control-label">Sản phẩm</label>  
           <div class="form-group">
                <a class="btn btn-primary btn-sm" type="button" href="{{ route('admin.order.item.create' , ['order' => $order->id]) }}">Thêm sản phẩm</a> 
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa sản phẩm" name="delete"> 
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
                                   <td>{{ $item->unit_price }}</del></td>
                                   <td><span>{{ $item->qty }}</span></td>
                                   <td><span>${{ $item->total_price }}</span></td>                                 
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>SubTotal</td>
                                    <td>${{ $sum }}</td>
                                </tr>
                            </tfoot>
                       </table>
                   </div>
               </div>
           </div>
           
           <div class="form-action">
               <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="edit">
           </div>
           <br>
       </form>
   </div>
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

@endsection