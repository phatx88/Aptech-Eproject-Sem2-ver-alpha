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
            <a href="{{ route('admin.order.index') }}">Order</a>
         </li>
          <li class="breadcrumb-item active">Add</li>
       </ol>
       <!-- /.row -->
       @include('errors.error')
       <form class="spacing" method="post" action="{{ route('admin.order.store') }}" enctype="multipart/form-data">
         @csrf
      <div class="row ">
         <div class="col-sm-4 col-lg-2">
            <label>Registered User (Optional) : </label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <select class="form-control" name="customer_id">
               <option value="">Guest</option>
               @foreach ($users as $user)
               <option value="{{ $user->id }}" {{ $user->id == old('customer_id') ? "selected" : "" }}>{{ $user->name }}</option>
               @endforeach
            </select>                  
         </div>
      </div>
      
      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Order Status:</label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <select name="order_status_id" class="form-control">  
               <option value="1">Ordered</option>   
             </select>
         </div>
      </div>
      
      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Recipient Name* : </label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <input type="text" name="shipping_fullname" value="{{ old('shipping_fullname') }}" class="form-control" required>                    
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Recipient Mobile* : </label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <input type="text" name="shipping_mobile" value="{{ old('shipping_mobile') }}" class="form-control" required>                    
         </div>
      </div>

      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Recipient Email* : </label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <input type="text" name="shipping_email" value="{{ old('shipping_email') }}" class="form-control" required>                    
         </div>
      </div>
      
      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Payment Method* : </label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <select name="payment_method" class="form-control">
               <option value="0" {{ old('payment_method') == 0 ? 'selected' : '' }}>COD</option>
               <option value="1" {{ old('payment_method') == 1 ? 'selected' : '' }}>Bank</option>
            </select>
         </div>
      </div>
  
      
      <div class="row">
         <div class="col-sm-4 col-lg-2">
             <label>Recipient Address* : </label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <div class="row-sm mb-2">
               <input type="text" name="shipping_housenumber_street" value="{{ old('shipping_housenumber_street') }}" placeholder="Enter House Street Number" class="form-control" required>
            </div>
             <div class="row">
                 <div class="col-sm-4">
                     <select class="form-control choose province" name="province" id="province" required>
                      <option value="">--Chọn Thành phố---</option>
                        @foreach($provinces as $key => $pvin)
                          <option value="{{ $pvin->id }}">{{ str_replace(['Thành phố' , 'Tỉnh'], '', $pvin->name) }}</option>
                        @endforeach
                    </select>
                  </div>
                 <div class="col-sm-4">
                     <select class="form-control choose district" name="district" id="district" required>
                      <option value="">--Chọn quận huyện---</option>
                     </select>
                 </div>
                 <div class="col-sm-4">
                     <select class="form-control ward" name="shipping_ward_id" id="ward" required>
                      <option value="">--Chọn xã phường---</option>
                     </select>
                 </div>
             </div>							
         </div>
         
     </div>

      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Responsible Staff* : </label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <select name="staff_id" class="form-control" required>
             <option value=""></option>
             @foreach ($staffs as $staff)
             <option value="{{ $staff->id }}">{{ $staff->name }}</option>
             @endforeach
           </select>                
         </div>
      </div>
           
           <div class="form-action">
               <input type="submit" class="btn btn-primary btn-sm" value="Add" name="save">
           </div>
           <br>
       </form>
       <!-- /.row -->
       <!-- /.row -->
       
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
   <!-- Sticky Footer -->
   @include('admin.footer')
</div>
@endsection
@section('scripts')
<script>
   $(document).ready(function() {
       $('.choose').on('change', function() {
           var action = $(this).attr('id');
           var ma_id = $(this).val();
           var _token = $('input[name="_token"]').val();
           var result = '';
           // alert(action);
           // alert(ma_id);
           if (action == 'province') {
               result = 'district';
           } else if (action == 'district') {
               result = 'ward';
           }
           $.ajax({
               url: '{{ url('select-delivery') }}',
               method: 'POST',
               data: {
                   action: action,
                   ma_id: ma_id,
                   _token: _token
               },
               success: function(data) {
                   // alert (result);
                   $('#' + result).html(data);
               }
           });
       });
   });
</script>
@endsection