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
             <a href="{{ route('admin.transport.index') }}">Transport</a>
         </li>
         <li class="breadcrumb-item active">Edit</li>
     </ol>
     @include('errors.error')
       <!-- /.row -->
       <!-- form -->
       <form method="post" action="{{ route('admin.transport.update' , ['transport' => $transport->id]) }}" enctype="multipart/form-data">
         @csrf
         @method('put')
          <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Province/Cities</label>  
             <div class="col-md-9 col-lg-6">
               <select name="" class="form-control province" readonly oninvalid="this.setCustomValidity('Please Choose a Valid Province/Cities')">
                  <option value="{{ $transport->province_id }}">{{ $transport->province->name }}</option>
          </select>           
             </div>
          </div>
          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="price">Shipping Fee</label>  
             <div class="col-md-9 col-lg-6"> 
                <input name="price" id="price" type="number" min="0" value="{{ $transport->price }}" class="form-control" oninvalid="this.setCustomValidity('Enter Shipping Fee')" required>                        
             </div>
          </div>
          <div class="form-action">
             <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
          </div>
       </form>
       <!-- /form -->
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer')
 </div>
 <!-- /.content-wrapper -->
@endsection