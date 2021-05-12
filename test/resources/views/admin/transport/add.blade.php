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
         <li class="breadcrumb-item active">Add</li>
     </ol>
     @include('errors.error')
       <!-- /.row -->
       <!-- form -->
       <form method="post" action="{{ route('admin.transport.store') }}" enctype="multipart/form-data">
         @csrf
          <div class="form-group row">
             <label class="col-md-12 control-label" for="name">Province/Cities</label>  
             <div class="col-md-9 col-lg-6">
                <select name="province_id" class="form-control province" required="" oninvalid="this.setCustomValidity('Please Choose a Valid Province/Cities')">
                    <option value="">Province/Cities</option>
                    @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option> 
                    @endforeach
                     
            </select>                      
             </div>
          </div>
          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="price">Shipping Fee</label>  
             <div class="col-md-9 col-lg-6"> 
                <input name="price" id="price" type="number" min="0" class="form-control" oninvalid="this.setCustomValidity('Enter Shipping Fee')" required>                        
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
@endsection