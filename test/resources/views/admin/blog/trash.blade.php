@extends('admin_layout')
@section('admin_content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">Blog</li>
            </ol>
             
         </div>
            {{-- MESSAGE  --}}
            @include('errors.message')
            <!-- DataTables Example -->
            <div class="action-bar">
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm">Add</a>
                {{-- <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete"> --}}
                {{-- <a href="{{ route('admin.product.export') }}" class="btn btn-success btn-sm">Export</a> --}}
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Product List
                    <a type="button" href="{{ route('clear-cache') }}" class="btn btn-success btn-sm float-right">Refresh</a>
                 </div>
                 @if(session()->get('message'))
                 <span class="alert alert-success">
                     {{ session()->get('message') }}
                 </span>
                 @php
                     session()->put('message', '');
                 @endphp
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable_3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>ID</th>
                                    <th style="width:50px">Author Name </th>
                                    <th>Featured Image</th>
                                    <th>Category Blog</th>
                                    <th>Title</th>
                                    <th>MetaTitle</th>
                                    <th>Slug</th>
                                    <th>Summary</th>
                                    <th>Pulished</th>
                                    <th>CreatedAt</th>
                                    <th>UpdatedAt</th>
                                    <th>PublishedAt</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody >
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($posts as $post)
                                    <tr>
                                        {{-- @can('restore', 'App/Models/Post') --}}
                                        <td><a class="btn btn-success btn-sm" href="{{ URL('admin/blog/restore/'.$post->id) }}">Restore</a></td>
                                        {{-- @endcan --}}
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td><img src="{{ asset('backend/images/blogs/' . $post->featured_image) }}">
                                        </td>
                                        <td>{{ $post->categoryblog->category_bname }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->metaTitle }}</td>
                                        <td>{{ $post->slug }}</td>
                                        <td>{{ $post->summary }}</td>

                                        <td>
                                            @if($post->published == 0)
                                            <a href="{{ url('admin/published-blog/'.$post->id) }}" class="btn btn-warning btn-sm">Publish</a>
                                            @else
                                            <p class="btn btn-primary btn-sm">Published</p>
                                            @endif
                                        </td>
                                        <td>{{ $post->createdAt }}</td>
                                        <td>
                                            @if($post->updatedAt == null)
                                            <p>Non updated yet</p>
                                            @else
                                            {{ $post->updatedAt }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($post->publishedAt == null)
                                            <p>Non published yet</p>
                                            @else
                                            <p>{{ $post->publishedAt }}</p>
                                            @endif
                                        </td>
                                        @can('delete', 'App\Models\Post')
                                        <td>
                                            <form
                                                action="{{ route('admin.blog.trash.forceDelete' , ['id' => $post->id]) }}"
                                                method="get">
                                                {{-- @csrf
                                                @method('DELETE') --}}
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
                                        </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
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
      $('#dataTable_3').DataTable({
        // flipping horizontal scroll bar in datatables refer to admin.css line 94
        order: [[ 1, "desc" ]],
        autoWidth: 'TRUE',
        scrollX : 'TRUE', 
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        columnDefs: [ {
        targets: [5,6,7,8],
        render: $.fn.dataTable.render.ellipsis( 30, true )
        } ],
    });
  </script>
    @endsection





