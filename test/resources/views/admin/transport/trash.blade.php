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
                    <a href="{{ route('admin.transport.index') }}">Product</a>
                </li>
                <li class="breadcrumb-item active">Trash</li>
            </ol>
            {{-- MESSAGE  --}}
            @include('errors.message')
            <!-- DataTables Example -->
            
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Restore List
                    <div class="float-right">
                        <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                    </div>
                 </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center" id="dataTable-3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    {{-- <th><input type="checkbox" onclick="checkAll(this)"></th> --}}
                                    <th>Action</th>
                                    <th class="filter-input">Transport Id</th>
                                    <th class="filter-input">Province/Cities</th>
                                    <th class="filter-input" >Shipping Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transports as $transport)
                                <tr>
                                  <td></td>
                                  <td>{{ $transport->id }}</td>
                                  <td>{{ str_replace(['Thành phố' , 'Thị xã', 'Huyện', 'Quận'], ['','','',''], $transport->province->name) }}</td>
                                  <td>${{ $transport->price }}</td>
                               </tr>    
                                @endforeach
                             </tbody>
                            <tfoot>
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
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        @include('admin.footer')
    </div>
    <!-- /.content-wrapper -->
    @endsection
    @section('scripts')
    <script type="text/javascript" src="{{ asset('backend/vendor/ckeditor/ckeditor.js') }}"></script>
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
              modal.find('.modal-title').text('Product Name : ' + title)
              modal.find('#description').val(description)
          })


      });

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




