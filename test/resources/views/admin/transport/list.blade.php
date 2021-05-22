@extends('admin_layout')
@section('admin_content')
<style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
#map {
  height: 100%;
}

#floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: "Roboto", "sans-serif";
  line-height: 30px;
  padding-left: 10px;
}

#right-panel {
  font-family: "Roboto", "sans-serif";
  line-height: 30px;
  padding-left: 10px;
  max-height: 500px;
  overflow-y: scroll;
}

#right-panel select,
#right-panel input {
  font-size: 15px;
}

#right-panel select {
  width: 100%;
}

#right-panel i {
  font-size: 12px;
}

#right-panel {
  height: 100%;
  float: right;
  width: 390px;
  overflow: auto;
}

#map {
  margin-right: 400px;
  height: 500px;
}

#floating-panel {
  background: #fff;
  padding: 5px;
  font-size: 14px;
  font-family: Arial;
  border: 1px solid #ccc;
  box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
  display: none;
}

@media print {
  #map {
    height: 500px;
    margin: 0;
  }

  #right-panel {
    float: none;
    width: auto;
  }
}
</style>
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
         <li class="breadcrumb-item active">List</li>
     </ol>
     @include('errors.message')
     
         <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-file-invoice-dollar"></i>
                       Distance Calculator
                    </div>
                    <div class="card-body">
                        <div id="floating-panel">
                            <strong>Start:</strong>
                            <select id="start">
                            {{-- <option value="">Select Start</option> --}}
                            @foreach ($transports as $transport)
                            <option value="{{ $transport->province->name }}">{{ $transport->province->name }}</option> 
                            @endforeach
                            </select>
                            <br />
                            <strong>End:</strong>
                            <select id="end">
                                {{-- <option value="">Select End</option> --}}
                                @foreach ($transports as $transport)
                                <option value="{{ $transport->province->name }}">{{ $transport->province->name }}</option> 
                                @endforeach
                            </select>
                          </div>
                          <div id="right-panel"></div>
                          <div id="map" height="100%"></div>
                    </div>
                </div>
            </div>
        </div>

       <!-- DataTables Example -->
       <div class="card mb-3">
         <div class="card-header">
            <i class="fas fa-table"></i>
            Transport List
            <div class="float-right">
                <a href="{{ route('admin.transport.create') }}" class="btn btn-primary btn-sm">Add</a>
                <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                <a href="#" class="btn btn-success btn-sm">Export</a>
            </div>
          </div>
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover text-center" id="dataTable-3" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                        <th class="filter-input">Transport Id</th>
                        <th class="filter-input">Province/Cities</th>
                         <th class="filter-input" >Shipping Fee</th>
                         <th>
                             Action
                         </th>
                         <th>
                         </th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($transports as $transport)
                      <tr>
                         <td>{{ $transport->id }}</td>
                        <td>{{ str_replace(['Thành phố' , 'Thị xã', 'Huyện', 'Quận'], ['','','',''], $transport->province->name) }}</td>
                        <td>${{ $transport->price }}</td>
                        <td><a href="{{ route('admin.transport.edit' , ['transport' => $transport->id]) }}" class="btn btn-warning btn-sm">Edit</a></td>
                        <td>
                            <form
                                action="{{ route('admin.transport.destroy', ['transport' => $transport->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            </form>
                        </td>
                     </tr>    
                      @endforeach
                   </tbody>
                   <tfoot>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                   </tfoot>
                </table>
             </div>
          </div>
       </div>
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer')
 </div>
@endsection
@section('scripts')
<script>
    // Create the script tag, set the appropriate attributes
    var script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDFfRF1akEo2X06xy_Vzvn6czOyKcraJKs&callback=initMap';
    script.async = true;

    // Attach your callback function to the `window` object
    window.initMap = function() {
        const directionsRenderer = new google.maps.DirectionsRenderer();
          const directionsService = new google.maps.DirectionsService();
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 7,
            center: { lat: 10.8231, lng: 106.6297 },
          });
          directionsRenderer.setMap(map);
          directionsRenderer.setPanel(document.getElementById("right-panel"));
          const control = document.getElementById("floating-panel");
          control.style.display = "block";
          map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
        
          const onChangeHandler = function () {
            calculateAndDisplayRoute(directionsService, directionsRenderer);
          };
          document.getElementById("start").addEventListener("change", onChangeHandler);
          document.getElementById("end").addEventListener("change", onChangeHandler);
        }
        
        function calculateAndDisplayRoute(directionsService, directionsRenderer) {
          const start = document.getElementById("start").value;
          const end = document.getElementById("end").value;
          directionsService.route(
            {
              origin: start,
              destination: end,
              travelMode: google.maps.TravelMode.DRIVING,
            },
            (response, status) => {
              if (status === "OK") {
                directionsRenderer.setDirections(response);
              } else {
                window.alert("Directions request failed due to " + status);
              }
            }
          );
    };

    // Append the 'script' element to 'head'
    document.head.appendChild(script);
</script>

<script>
   $(document).ready(function() {
       var table = $('#dataTable-3').DataTable({
           // flipping horizontal scroll bar in datatables refer to admin.css line 94
           order: [
               [1, "asc"]
           ],
           autoWidth: 'TRUE',
           scrollX: 'TRUE',
           lengthMenu: [
               [5, 10, 25, 50, -1],
               [5, 10, 25, 50, "All"]
           ],
           columnDefs: [{
               targets: 2,
               render: $.fn.dataTable.render.ellipsis(15, true)
           }],
       });

       //SEARCH INPUT BY COLUMNS// - put class on top of header

       table.columns('.filter-input').every(function(i) {
           var column = table.column(i);

           // Create the select list and search operation
           var input = $(`<input type='search' class='form-control form-control-sm' placeholder='Search'>`)
               .appendTo(
                   this.footer()
               )
               .on('keyup change', function() {
                   column
                       .search($(this).val())
                       .draw();
               });
       });

       //SEARCH INPUT BY COLUMNS//


       //SEARCH SELECT BY COLUMNS//

       table.columns('.filter-select').every(function(i) {
           var column = table.column(i);

           // Create the select list and search operation
           var select = $(`<select class='form-control form-control-sm'/>`)
               .appendTo(
                   this.footer()
               )
               .on('change', function() {
                   column
                       .search($(this).val())
                       .draw();
               });

           // Get the search data for the first column and add to the select list
           select.append($('<option value="">Select</option>'));
           this
               .cache('search')
               .sort()
               .unique()
               .each(function(d) {
                   select.append($('<option value="' + d + '">' + d + '</option>'));
               });
       });

       //SEARCH SELECT BY COLUMNS//

   });

</script>


@endsection