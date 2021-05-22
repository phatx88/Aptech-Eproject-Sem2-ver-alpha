@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
         <li class="breadcrumb-item">
             <a href="{{ route('admin.dashboard.index') }}">Admin</a>
         </li>
         <li class="breadcrumb-item">
             <a href="{{ route('admin.newsletter.index') }}">Newsletter</a>
         </li>
         <li class="breadcrumb-item active">List</li>
     </ol>
       @include('errors.message')
       <!-- DataTables Example -->
       <div class="row mb-5">
          {{-- NewsLetter --}}
       <div class="col-12 col-md-6">
      <form action="{{ url('admin/newsletter/sendmail') }}" method="POST" id="NewsLetter">
         @csrf
         <div class="card">
            <div class="card-header">
                <i class="fas fa-table"></i>
                NewsLetter List
                <div class="float-right">
                    <a href="{{ route('admin.newsletter.index') }}" class="btn btn-primary btn-sm">View</a>
                    <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                    <a href="#" class="btn btn-success btn-sm">Export</a>
                </div>
              </div>
              <div class="card-body">
                 <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                          <tr>
                             <th><input type="checkbox" onclick="checkAll(this)"></th>
                             <th>Email</th>
                             <th></th>
                             <th></th>
                          </tr>
                       </thead>
                       <tbody>
                           @foreach ($emails as $email)
                           <tr>
                            <td><input type="checkbox" name="checkboxes[]" value="{{ $email->email }}"></td>
                            <td>{{$email->email}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                           @endforeach
                       </tbody>
                    </table>
                 </div>
              </div>
           </div>
       </div>

       {{-- Coupon --}}
       <div class="col-12 col-md-6">
         <div class="card mb-3">
            <div class="card-header">
               <i class="fas fa-gift"></i>
               Coupon List
               <div class="float-right">
                  <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary btn-sm text-white">View </a>
                  <a href="{{ route('admin.coupon.export') }}"><input type="button" class="btn btn-success btn-sm" value="Export" name="export"></a>
               </div>
           </div>
             <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-hover" id="dataTable_2" width="100%" cellspacing="0">
                      <thead>
                         <tr>
   
                            <th>
                                Id
                            </th>
                            <th>
                              Name
                            </th>
                            <th>
                               Code
                           </th>
                           <th>
                               Number
                           </th>
                         
                         </tr>
                      </thead>
                      <tbody>
                          @foreach ($coupons as $coupon)
                          <tr>
                           <td >{{ $coupon->id }}</td>
                           <td >{{ $coupon->name }}</td>
                           <td >{{ $coupon->code }}</td>
                           <td >{{ $coupon->number }}</td>
                       </tr>
                          @endforeach
                      </tbody>
                   </table>
                </div>
             </div>
          </div>
       </div>

      </div>
      
      <h2 class="mb-5">Send NewsLetter</h2>
       {{-- AJax load error messages --}}
       <div class="alert alert-danger print-error-msg" style="display:none">
         <ul class="m-0 p-2"></ul>
         </div>
     {{-- AJax load error messages --}}
          <div class="row form-group">
             <div class="col-md-9 col-lg-6">
                <input class="form-control" type="text" name="subject" placeholder="Subject*" required>
             </div>
          </div>
          <div class="row form-group">
             <div class="col-md-12">
                <textarea class="form-control" name="body" id="description" rows="10" cols="80" placeholder="Body Message*" required>
                </textarea>
             </div>
          </div>
          <div class="row form-group">
             <div class="col-md-12 text-center">
                <input type="button" value="Send Mail" class="btn btn-primary btn-sm" id="sendMail" title="Send All if nothing is selected">
             </div>
          </div>      
         
          
       </form>
       

    </div>
    {{-- <script type="text/javascript" src="{{ asset('backend/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>CKEDITOR.replace('description');</script> --}}
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer')
 </div>
 <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script>
        $("input#sendMail").click(function(event) {
            event.preventDefault();
            var post_url = $("form#NewsLetter").attr("action");
            var request_method = $("form#NewsLetter").attr("method");
            var form_data = $("form#NewsLetter").serialize();
            // console.log(form_data);
              // Clear Error Message
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'none');

            $.ajax({
                url: post_url,
                type: request_method,
                data: form_data,
                success: function() {
                        notyf.success('NewsLetter Send');
                        setTimeout(() => {
                           window.location.reload();
                        }, 2000);
                },
                error: function(data) {
                    // Chuyển từ json về array có key và value
                    var errors = data.responseJSON;
                    printErrorMsg(errors);
                    notyf.error('Sending Error!');
                }
            });
        });

        //nhận báo lội từ server qua phương thức Validator bằng Ajax
        function printErrorMsg(msg) {

         //Display Error HTML
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display', 'block');
         $.each(msg, function(key, value) {
            var errors = `<li>` + value + `</li>`;
            $(".print-error-msg").find("ul").append(errors);
         });
         }

    </script>

   <script language="JavaScript">
      function checkAll(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
               checkboxes[i].checked = source.checked;
      }
      }
   </script>  
@endsection