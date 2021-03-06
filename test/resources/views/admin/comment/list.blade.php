@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard.index') }}">Admin</a>
         </li>
         <li class="breadcrumb-item active">Comment</li>
      </ol>
      @include('errors.message')
       <!-- DataTables Example -->
       <div class="action-bar">

       </div>
       <div class="card mb-3">
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                         <th><input type="checkbox" onclick="checkAll(this)"></th>
                         <th>Email</th>
                         <th>Name </th>
                         <th>Star</th>
                         <th>Created Date</th>
                         <th>Content</th>
                         <th></th>
                      </tr>
                   </thead>
                   <tbody>

                       @foreach ($comments as $comment)
                      <tr>
                         <td><input type="checkbox"></td>
                         <td>{{ $comment->email }}</td>
                         <td>{{ $comment->fullname }} </td>
                         <td>{{ $comment->star }}</td>
                         <td>{{ $comment->created }}</td>
                         <td>{{ $comment->description }}</td>
                         <form action="{{ URL('admin/comment/delete', ['comment'=>$comment->id]) }}" method="POST">
                            @csrf
                            <td><button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button></td>
                        </form>
                      </tr>

                      @endforeach

                   </tbody>
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
