@extends('admin_layout')
@section('admin_content')

    <div id="content-wrapper">

       <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
             <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          @include('errors.message')
          <div class="mb-3 my-3">
             <a href="#" class="active btn btn-primary">Hôm nay</a>
             <a href="#" class="btn btn-primary">Hôm qua</a>
             <a href="#" class="btn btn-primary">Tuần này</a>
             <a href="#" class="btn btn-primary">Tháng này</a>
             <a href="#" class="btn btn-primary">3 tháng</a>
             <a href="#" class="btn btn-primary">Năm này</a>
             <div class="dropdown" style="display:inline-block">
                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                   <div style="margin:20px">
                      Từ ngày <input type="date" class="form-control" id="usr">
                      Đến ngày <input type="date" class="form-control" id="usr">
                      <br>
                      <input type="submit" value="Tìm" class="btn btn-primary form-control">
                   </div>
                </div>
             </div>
          </div>
         
          <!-- Icon Cards-->
          <div class="row">
             <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-warning o-hidden h-100">
                   <div class="card-body">
                      <div class="card-body-icon">
                         <i class="fas fa-fw fa-list"></i>
                      </div>
                      <div class="mr-5">2 Đơn hàng</div>
                   </div>
                   <a class="card-footer text-white clearfix small z-1" href="#">
                   <span class="float-left">Chi tiết</span>
                   <span class="float-right">
                   <i class="fas fa-angle-right"></i>
                   </span>
                   </a>
                </div>
             </div>
             <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-success o-hidden h-100">
                   <div class="card-body">
                      <div class="card-body-icon">
                         <i class="fas fa-fw fa-shopping-cart"></i>
                      </div>
                      <div class="mr-5">Doanh thu 3,500,000 đ</div>
                   </div>
                   <a class="card-footer text-white clearfix small z-1" href="#">
                   <span class="float-left">Chi tiết</span>
                   <span class="float-right">
                   <i class="fas fa-angle-right"></i>
                   </span>
                   </a>
                </div>
             </div>
             <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card text-white bg-danger o-hidden h-100">
                   <div class="card-body">
                      <div class="card-body-icon">
                         <i class="fas fa-fw fa-life-ring"></i>
                      </div>
                      <div class="mr-5">1 đơn hàng bị hủy</div>
                   </div>
                   <a class="card-footer text-white clearfix small z-1" href="#">
                   <span class="float-left">Chi tiết</span>
                   <span class="float-right">
                   <i class="fas fa-angle-right"></i>
                   </span>
                   </a>
                </div>
             </div>
          </div>
           {{-- Chart Larapex --}}
         <div class="row mb-3">
            <div class="col-md-6">
               <div class="card">
                  <div class="card-header">
                     <i class="fas fa-users"></i>
                     Visitor Chart
                  </div>
                     <div class="card-body">
                        {!! $visitChart->container() !!}
                     </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="card">
                  <div class="card-header">
                     <i class="fas fa-user"></i>
                     Users Chart
                  </div>
                     <div class="card-body">
                        {!! $usersChart->container() !!}
                     </div>
               </div>
            </div>
         </div>
          <!-- DataTables Example -->
          <div class="card mb-3">
             <div class="card-header">
                <i class="fas fa-table"></i>
                Order Summary
             </div>
             <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                        <tr>
                            <th><input type="checkbox" onclick="checkAll(this)"></th>
                            <th>Mã</th>
                            <th>Tên khách hàng</th>
                            <th>Điện thoai</th>
                            <th>Email</th>
                            <th>Trạng Thái</th>
                            <th>Ngày đặt hàng</th>
                            <th>Người nhận</th>
                            <th>Số điện thoại người nhận</th>
                            <th>Hình thức thanh toán</th>
                            <th>Tạm tính</th>
                            <th>Phí giao hàng</th>
                            <th>Tổng cộng</th>
                            <th>Địa chỉ giao hàng</th>
                            <th>Ngày giao</th>
                            <th>Nhân viên phụ trách</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>{{ $order->id  }}</td>
                            <td>{{ $order->user->name ?? "Guest"}}</td>
                            <td>{{ $order->user->mobile ?? ""}}</td>
                            <td>{{ $order->user->email ?? ""}}</td>
                            <td>{{ $order->status->name }}</td>
                            <td>{{ $order->created_date }}</td>
                            <td>{{ $order->shipping_fullname }}</td>
                            <td>{{ $order->shipping_mobile }}</td>
                            <td>{{ $order->payment_method == 0 ? 'COD':'BANK'}}</td>
                            <td>${{ $sum = $orderItems->where("order_id" , '=' , $order->id)->sum('total_price')}}</td>
                            {{-- tạm tính là tổng sum của cột total_price trong bảng order.item where id thuộc về bảng order --}}
                            <td>${{ $order->shipping_fee }}</td>
                            <td>${{ $sum + $order->shipping_fee}}</td>
                            <td>{{ $order->shipping_housenumber_street }},
                                {{ $order->ward->name ?? "" }} , {{ $order->ward->district->name ?? "" }} , {{ $order->ward->district->province->name?? "" }}.
                            </td>
                            <td>{{ $order->delivered_date }}</td>
                            <td></td>
                            <td> </td>
                            <td> <input type="button" onclick="Edit('1');" value="Sửa"
                                    class="btn btn-warning btn-sm"></td>
                            <td> <input type="button" onclick="DELETE('1');" value="Xóa"
                                    class="btn btn-danger btn-sm"></td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th><input type="checkbox" onclick="checkAll(this)"></th>
                            <th>Mã</th>
                            <th>Tên khách hàng</th>
                            <th>Điện thoai</th>
                            <th>Email</th>
                            <th>Trạng Thái</th>
                            <th>Ngày đặt hàng</th>
                            <th>Người nhận</th>
                            <th>Số điện thoại người nhận</th>
                            <th>Hình thức thanh toán</th>
                            <th>Tạm tính</th>
                            <th>Phí giao hàng</th>
                            <th>Tổng cộng</th>
                            <th>Địa chỉ giao hàng</th>
                            <th>Ngày giao</th>
                            <th>Nhân viên phụ trách</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                   </table>
                </div>
             </div>
          </div>
       </div>
       <!-- /.container-fluid -->

    <!-- /.content-wrapper -->
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer')
    <!-- Sticky Footer -->
 </div>
 <!-- /.content-wrapper -->


@endsection

@section('scripts')
{{ $usersChart->script() }}
{{ $visitChart->script() }}
@endsection
