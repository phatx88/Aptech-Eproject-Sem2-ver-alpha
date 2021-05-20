@extends('admin_layout')

@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
        {{-- <a class="introjs-icon" title="Page Tour" onclick="userBoarding()">
            <i class="fa fa-2x fa-question-circle blob red"></i>
        </a> --}}
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard.index') }}">Admin</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/backup') }}">Back Up</a>
            </li>
        </ol>
        @include('errors.message')

        {{-- DATATABLE LOOKUP ITEMS --}}
        <div class="row mb-3">

           {{-- BACK UP  --}}

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-database"></i>
                        Database Backups
                        <a id="create-new-backup-button" href="{{ url('admin/backup/create') }}" class="btn btn-primary pull-right"
                            ><i
                                    class="fas fa-save"></i> Backup DB
                            </a>
                    </div>
                    <div class="card-body">
                        @if (count($backups))
                        <table class="table table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead class="">
                                <tr>
                                    <th>File</th>
                                    <th>Size</th>
                                    <th>Date</th>
                                    <th>Age</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($backups as $backup)
                                    <tr>
                                        <td>{{ $backup['file_name'] }}</td>
                                        <td>{{ $backup['file_size'] }}</td>
                                        <td>
                                            {{ date('d/M/Y, g:ia', strtotime($backup['last_modified'])) }}
                                        </td>
                                        <td>
                                            {{ diff_date_for_humans($backup['last_modified']) }}
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-success" href="{{ url('admin/backup/download/'.$backup['file_name']) }}" title="DOWNLOAD">
                                                <i class="fas fa-download"></i> </a>
                                            <a class="btn btn-xs btn-danger" data-button-type="delete" href="{{ url('admin/backup/delete/'.$backup['file_name']) }}"  title="DELETE" onclick="return confirm('Are you Sure?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            <p class="text-muted">No backups available</p>
                        </div>
                    @endif
                    </div>
                </div>
            </div>


    
        </div>
    
    </div>

    <!-- Sticky Footer -->
    @include('admin.footer')
    <!-- Sticky Footer -->
   
</div>
<!-- /.content-wrapper -->
@endsection
