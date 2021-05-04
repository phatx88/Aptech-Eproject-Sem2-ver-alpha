@extends('admin_layout')
@section('admin_content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            @include('errors.message')
            {{-- <div class="mb-3 my-3">
                <a href="#" class="active btn btn-primary">Hôm nay</a>
                <a href="#" class="btn btn-primary">Hôm qua</a>
                <a href="#" class="btn btn-primary">Tuần này</a>
                <a href="#" class="btn btn-primary">Tháng này</a>
                <a href="#" class="btn btn-primary">3 tháng</a>
                <a href="#" class="btn btn-primary">Năm này</a>
                <div class="dropdown" style="display:inline-block">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <div style="margin:20px">
                            Từ ngày <input type="date" class="form-control" id="usr">
                            Đến ngày <input type="date" class="form-control" id="usr">
                            <br>
                            <input type="submit" value="Tìm" class="btn btn-primary form-control">
                        </div>
                    </div>
                </div>
            </div> --}}

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
                            <div class="mr-5">${{ number_format($orders->sum('total'), 0) }} in Sales</div>
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
            {{-- GOOGLE GEOCHART --}}

            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-shipping-fast"></i>
                            Most Ordered by Regions
                        </div>
                        <div class="card-body">
                            <div id="regions_div" style="width: 100%; height: auto;"
                                data-url="{{ url('fetch-order-data') }}"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUBBLE CHART --}}

            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-cash-register"></i>
                            Products Inventory and Sales Report
                        </div>
                        <div class="card-body">
                            <div id="textstyle" style="width: 100%; height: 500px;"
                                data-url="{{ url('fetch-product-sale-data') }}"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DATATABLE LOOKUP ITEMS --}}
            <div class="row mb-3">

               {{-- PRODUCT  --}}

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-wine-bottle"></i>
                            Product Lookup
                            <a type="button" href="{{ route('admin.product.export') }}"
                                class="btn btn-success btn-sm float-right">Export</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Id</th>
                                            <th>Image</th>
                                            <th style="width:50px">Name </th>
                                            <th>Inventory</th>
                                            <th>Sale Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($products as $product)
                                            <tr class="text-center">
                                                <td>{{ $product->id }}</td>
                                                <td><img class="m-auto d-block"
                                                    src="{{ asset('frontend/images/products/' . $product->featured_image) }}"></td>
                                                <td style="width:50px">{{ $product->name }}</td>
                                                <td>{{ $product->inventory_qty }}</td>
                                                <td>${{ $product->sale_price }}</td>
                                                <td><a href="{{ route('admin.product.edit', ['product' => $product->id]) }}"
                                                    class="btn btn-warning btn-sm">Edit</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ORDER  --}}

                <div class="col-md-6">
                  <div class="card">
                      <div class="card-header">
                          <i class="fas fa-file-invoice-dollar"></i>
                          Lastest Order
                          <a type="button" href="{{ route('admin.order.export') }}"
                              class="btn btn-success btn-sm float-right">Export</a>
                      </div>
                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover" id="dataTable_2" width="100%" cellspacing="0">
                                  <thead>
                                      <tr class="text-center">
                                          {{-- <th><input type="checkbox" onclick="checkAll(this)"></th> --}}
                                          <th>Id</th>
                                          <th style="width:50px">Created Date </th>
                                          <th>Shipping Fee</th>
                                          <th>Total</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @php
                                          $count = 0;
                                      @endphp
                                      @foreach ($orders as $order)
                                          <tr class="text-center">
                                              <td>{{ $order->order_id }}</td>
                                              <td>{{ $order->created_date }}</td>
                                              <td>{{ $order->shipping_fee }}</td>
                                              <td>${{ $order->total }}</td>
                                              <td> 
                                                  <a type="button" href="{{ route('admin.order.edit' , ['order' => $order->order_id]) }}" value=""
                                                class="btn btn-warning btn-sm">Edit</a>
                                            </td>
                                          </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            {{-- Apex Chart - Sales --}}

            <div class="row mb-3">
               <div class="col-12">
                   <div class="card">
                       <div class="card-header">
                           <i class="fas fa-chart-line"></i>
                           Revenue Trend
                       </div>
                       <div class="card-body">
                           {!! $saleChart->container() !!}
                       </div>
                   </div>
               </div>
           </div>


            {{-- Apex Chart - Order --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-file-invoice-dollar"></i>
                            Orders per Month
                        </div>
                        <div class="card-body">
                            {!! $orderbar->container() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-money-bill"></i>
                            Sales per Month
                        </div>
                        <div class="card-body">
                            {!! $salebar->container() !!}
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Apex Chart - Visitors & Users --}}

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

        </div>
        {{-- Chart Larapex --}}
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
                                <textarea name="description" id="description" class="form-control" rows="10"
                                    cols="60"></textarea>
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

    {{-- GOOGLE GEOCHART --}}

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['geochart'],
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
            $.each(arrObj, function(k, obj) {
                var data = Object.keys(obj).map(function(key) {
                    return obj[key];
                });
                //step 4 : insert each array(v,v) to array of data
                arrdata.push(data);
            });

            //step 5 : Using DataTable() method and addRows to data
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Province');
            data.addColumn('number', 'Total Orders');
            data.addColumn('number', 'Total Sales');
            data.addRows(arrdata);

            // console.log(arrdata);

            var options = {
                region: 'VN',
                displayMode: 'regions',
                resolution: 'provinces',
                colorAxis: {
                    minValue: 0,
                    colors: ['#f1f1f1', '#FF0000']
                },
                keepAspectRatio: false,
            };

            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

            chart.draw(data, options);
        }

    </script>

    {{-- GOOGLE BUBBLE CHART --}}

    <script type="text/javascript">
        google.charts.load("current", {
            'packages': ["corechart"],
            'mapsApiKey': 'AIzaSyDFfRF1akEo2X06xy_Vzvn6czOyKcraJKs'
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var url = $('#textstyle').data('url');
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
            $.each(arrObj, function(k, obj) {
                var data = Object.keys(obj).map(function(key) {
                    return obj[key];
                });
                //step 4 : insert each array(v,v) to array of data
                arrdata.push(data);
            });

           

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Product Id');
            data.addColumn('number', 'Item Price');
            data.addColumn('number', 'Inventory');
            data.addColumn('number', 'Items Sold');
            data.addColumn('number', 'Total Sales');
            data.addRows(arrdata);

            var options = {
                title: 'Products Inventory & Sales Report',
                hAxis: {
                    title: 'Price Per Product',
                    format: 'currency',
                    minValue: 1000,
                },
                vAxis: {
                    title: 'Inventory',
                    minValue: 150,
                },
                colorAxis: {
                    colors: ['yellow', 'red']
                },
                bubble: {
                    textStyle: {
                        fontSize: 12,
                        fontName: 'Times-Roman',
                        color: 'green',
                        bold: true,
                        italic: true
                    }
                }
            };

            var chart = new google.visualization.BubbleChart(document.getElementById('textstyle'));

            chart.draw(data, options);
        }

        $(window).resize(function(){
            drawRegionsMap();
            drawChart();
        });

    </script>

    {{ $saleChart->script() }}
    {{ $orderbar->script() }}
    {{ $salebar->script() }}
    {{ $usersChart->script() }}
    {{ $visitChart->script() }}

@endsection
