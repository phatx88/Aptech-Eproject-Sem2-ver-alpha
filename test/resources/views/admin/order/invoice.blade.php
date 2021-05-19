<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Tổng quan</title>
      <!-- Create favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/images/logo.jpg')}}" />
      <!-- Custom fonts for this template-->
      <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template-->
        <link href="{{asset('backend/css/sb-admin.css')}}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link rel="stylesheet" href="{{ asset('frontend/css/color4.css') }}">
   </head>
   <body style="background-color: rgba(238, 238, 238, 0.3);">
   <section class="theme-invoice">
    <div class="container " >
      <div class="row">
        <div class="col-12">   
          <div class="invoice-popup overflow-auto">
            <div>
              <div class="row invoice-header">               
                <div class="col-md-6 ">
                  <div class="header-left">
                    <div class="brand-logo">
                      <a href="{{ route('home.index') }}">
                        <img src="{{ asset('frontend/images/bg_4.jpg') }}" alt="" style="width: 250px; height: 125px">
                        
                      </a>  
                    </div>
                  </div>  
                </div>
                <div class="col-md-6 ">   
                  <div class="header-right">
                    <ul>
                      <li><h3>Liquore <span style="color: red; front-weight: 600;">Store</span></h3></li>
                      <li>123 Some Address, ward, disctrict, Vietnam</li>
                      <li>Call Us: 123-456-7898</li>
                      <li>Support@liquore.Com</li>
                    </ul>
                  </div>                    
                </div>               
              </div>
              <div class="invoice-breadcrumb">
                <div class="row">
                  <div class="col-md-6">
                    <div class="breadcrumb-left">
                      <ul>
                        <li>Customer:-<span>{{ $order->shipping_fullname }}</span></li>
                        <li>Address:-<span>{{ $order->shipping_housenumber_street.', ' }}{{ $order->ward->name.', ' }}{{ $order->ward->district->name.', ' }}{{ $order->ward->district->province->name }}</span></li>
                        <li>Mobile:-<span>{{ $order->shipping_mobile }}</span></li>
                        <li>Email:-<span>{{ $order->shipping_email }}</span></li>
                      </ul>                   
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="breadcrumb-right">
                      <ul>
                        <li>Invoice Date:- <span>{{ date('Y-m-d', strtotime($order->created_date)) }}</span></li>
                        <li>Issue Date:- <span>{{ date('Y-m-d', strtotime(now())) }}</span></li>
                        <li>Invoice No:-<span>{{ $order->id }}</span></li>
                        <li>Customer Acc No:-<span>{{ $order->user->id ?? 'N/A' }}</span></li>
                      </ul>                                                                    
                    </div>
                  </div>
                </div>
              </div>
              @php
              $no = 1;    
              @endphp
              <div class="table-responsive-md">
                <table class="invoice-table " >
                  <thead>
                      <tr>
                          <th>no.</th>
                          <th>item detail</th>                       
                          <th>qty</th>
                          <th>price</th>                       
                          <th>amout</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($orderItem as $item)
                      <tr>
                          <td>{{ $no++ }}</td>
                          <td>                               
                              <h3>
                                {{ substr($products->find($item->product_id)->name, 0 , strpos($products->find($item->product_id)->name, ' ' , 15)) }}
                                </h3>
                                <p>{{ $products->find($item->product_id)->name }}</p>
                            </td>                       
                            <td>{{ $item->qty }}</td>
                            <td>${{ $item->unit_price }}</td>
                            <td>${{ $item->total_price }}</td>
                        </tr>
                        @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                          <td colspan="2"></td>
                          <td colspan="2">Subtotal</td>
                          <td>@php
                              $subtotal = 0;
                              foreach ($orderItem as $item):
                              $subtotal += $item->total_price;
                              endforeach;
                              echo '$'.$subtotal;
                              @endphp
                          </td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td colspan="2">Shipping Fee</td>
                        <td>${{ $order->shipping_fee ?? 0}}</td>
                    </tr>
                      <tr style="color: green">
                          <td colspan="2"></td>
                          <td colspan="2">Discount</td>
                          <td>${{ $order->coupon->number ?? 0}}</td>
                      </tr>
                      <tr>
                          <td colspan="2"></td>
                          <td colspan="2">GRAND TOTAL</td>
                          <td>${{ $subtotal + ($order->shipping_fee ?? 0) - ($order->coupon->number ?? 0) }}</td>
                      </tr>
                  </tfoot>
                </table> 
                <div class="row print-bar">
                  <div class="col-md-6">
                    <div class="printbar-left">
                      <button id="exportpdf" class="btn btn-solid btn-md">
                        <i class="fa fa-file"></i> 
                        Export as PDF
                      </button> 
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="printbar-right">
                      <button id="printinvoice" class="btn btn-solid btn-md ">
                                <i class="fa fa-print"></i> 
                                Print
                              </button>
                    </div>
                  </div>
                </div>   
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </section>
  {{-- <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('frontend/js/invoice.js') }}"></script>
  
</body>
 </html>
