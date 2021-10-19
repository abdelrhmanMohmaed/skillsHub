@extends('admin.layout')

@section('title')
    Admins
@endsection
@section('main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Admins</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Admins</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Admins</h3>
                                <div class="card-tools">
                                    <div class="card-tools">
                                        <a href="{{ url('dashboard/admins/create') }}" class="btn btn-sm btn-primary">
                                            Add New
                                        </a>
                                    </div>
                                </div>
                            </div>


                            @include('admin.inc.messages')

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name </th>
                                            <th>E-Mail</th>
                                            <th>Role</th>
                                            <th>Verified</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($admins as $admin)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td> 
                                                <td>{{ $admin->role->name }}</td>
                                                @if ($admin->email_verified_at !== null)
                                                    <td><span class="badge bg-success">Yes</span></td>
                                                @else
                                                    <td><span class="badge bg-danger">No</span></td>
                                                @endif

                                                <td>
                                                    @if ($admin->role->name == 'admin')
                                                        <a href="{{ url("dashboard/admins/promote/$admin->id") }}"
                                                            class="btn btn-sm btn-success">
                                                            </i><i class="fas fa-level-up-alt"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ url("dashboard/admins/demote/$admin->id") }}"
                                                            class="btn btn-sm btn-danger">
                                                            </i><i class="fas fa-level-down-alt"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                                {{-- <button type="button" class="btn btn-sm btn-info edit-btn"
                                                        data-id="{{ $cat->id }}"
                                                        data-name-ar="{{ $cat->name('ar') }}"
                                                        data-name-en="{{ $cat->name('en') }}" data-toggle="modal"
                                                        data-target="#edit-modal">
                                                        <i class="fas fa-edit"></i>
                                                    </button> --}}



                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex my-3 justify-content-center ">
                                    {{ $admins->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- .add-modal -->
    {{-- <div class="modal fade" id="add-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Categorie</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                    @include('admin.inc.errors')

                    <form method="POST" action="{{ url('dashboard/categories/store') }}" id="add-form">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name-en">Name (EN)</label>
                                        <input name="name_en" type="text" class="form-control" id="name-en">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_ar">Name (AR)</label>
                                        <input name="name_ar" type="text" class="form-control" id="name-ar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button form="add-form" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}
    <!-- /.add-modal -->


@endsection
