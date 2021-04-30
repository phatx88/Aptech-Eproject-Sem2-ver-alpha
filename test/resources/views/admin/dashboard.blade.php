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
                      <div class="mr-5">{{ $orders->count() }} Orders</div>
                   </div>
                   <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.order.index') }}">
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
          {{-- GOOGLE GEOCHART  --}}
          <div class="row mb-3">
             <div class="col-12">
                <div class="card">
                   <div class="card-header">
                     <i class="fas fa-shipping-fast"></i>
                     Most Delivered To
                   </div>
                   <div class="card-body">
                      <div id="regions_div" style="width: 100%; height: 500px;" data-url="{{ url('fetch-order-data') }}"></div>
                   </div>
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
                <a type="button" href="{{ route('clear-cache') }}" class="btn btn-success btn-sm float-right">Refresh</a>
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
                            <td><button class="btn btn-info btn-sm m-auto" data-toggle="modal" data-target="#ModalDescription"
                              data-description="{{ $order->shipping_housenumber_street }}, {{ $order->ward->name ?? "" }} , {{ $order->ward->district->name ?? "" }} , {{ $order->ward->district->province->name?? "" }}"
                              data-title="{{ $order->shipping_fullname }}">Show</button></td>
                            {{-- <td>{{ $order->shipping_housenumber_street }},
                                {{ $order->ward->name ?? "" }} , {{ $order->ward->district->name ?? "" }} , {{ $order->ward->district->province->name?? "" }}.
                            </td> --}}
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
    {{-- Description Modal --}}
    <div class="modal fade" id="ModalDescription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                   <label class="col-md-12 control-label" for="description">Description</label>
                   <div class="col-md-12">
                      <textarea name="description" id="description" class="form-control" rows="10" cols="60"></textarea>
                   </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
 </div>
 <!-- /.content-wrapper -->


@endsection

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages':['geochart'],
    // Note: you will need to get a mapsApiKey for your project.
    // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
    'mapsApiKey': 'AIzaSyDFfRF1akEo2X06xy_Vzvn6czOyKcraJKs'
  });
  google.charts.setOnLoadCallback(drawRegionsMap);

  function drawRegionsMap() {
   var url = $('#regions_div').data('url');
     //step 1 : Get data from laravel controller via route
   var jsonData = $.ajax({
          url: url,
          dataType: "json",
          async: false
          }).responseText;
   //step 2 : parse JSON to js Array of Obj
   var arrObj = JSON.parse(jsonData);
   var arrdata = [];
   //step 3 : loop through each obj convert into array of value : value
   $.each(arrObj, function ( k, obj ) { 
       var data = Object.keys(obj).map(function(key){
         return obj[key];
       });
   //step 4 : insert each array(v,v) to array of data
       arrdata.push(data);
   });

   //step 5 : Using DataTable() method and addRows to data
    var data = new google.visualization.DataTable();

    data.addColumn('string' , 'Province');
    data.addColumn('number' , 'Ordered');
    data.addRows(arrdata);

    var options = {
      region: 'VN',
      displayMode: 'regions',
      resolution: 'provinces',
    };

    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

    chart.draw(data, options);
  }
</script>

{{ $usersChart->script() }}
{{ $visitChart->script() }}

<script>
   $(document).ready(function() {

     //   CKEDITOR.replace('description')
       $('#ModalDescription').on('show.bs.modal', function(event) {
         //   even.preventDefault()
           var button = $(event.relatedTarget) // Button that triggered the modal
           var description = button.data('description') // Extract info from data-* attributes
           var title = button.data('title') // Extract info from data-* attributes
           // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
           // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
           var modal = $(this)
           modal.find('.modal-title').text('Shipping Address : ' + title)
           modal.find('#description').val(description)
       })


   });

</script>
@endsection
