@extends('admin.layout')

@section('title')
    Categories
@endsection
@section('main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                                <h3 class="card-title">All Categories</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#add-modal">
                                        Add New
                                    </button>
                                </div>
                            </div>


                            @include('admin.inc.messages')

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name (en)</th>
                                            <th>Name (ar)</th>
                                            <th>Active</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cats as $cat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $cat->name('en') }}</td>
                                                <td>{{ $cat->name('ar') }}</td>
                                                @if ($cat->active)
                                                    <td><span class="badge bg-success">Yes</span></td>
                                                @else
                                                    <td><span class="badge bg-danger">No</span></td>
                                                @endif
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info edit-btn"
                                                        data-id="{{ $cat->id }}"
                                                        data-name-ar="{{ $cat->name('ar') }}"
                                                        data-name-en="{{ $cat->name('en') }}" data-toggle="modal"
                                                        data-target="#edit-modal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <a href="{{ url("dashboard/categories/delete/$cat->id") }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="{{ url("dashboard/categories/toggle/$cat->id") }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-toggle-off"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex my-3 justify-content-center ">
                                    {{ $cats->links() }}
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
    <div class="modal fade" id="add-modal" aria-hidden="true" style="display: none;">
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
    </div>
    <!-- /.add-modal -->


    <!-- .edit-modal -->
    <div class="modal fade" id="edit-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Categorie</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    @include('admin.inc.errors')

                    <form method="POST" action="{{ url('dashboard/categories/update') }}" id="edit-form">
                        @csrf
                        <input type="hidden" name="id" id="edit-form-id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit-form-name-en">Name (EN)</label>
                                        <input name="name_en" type="text" class="form-control" id="edit-form-name-en">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit-form-name-ar">Name (AR)</label>
                                        <input name="name_ar" type="text" class="form-control" id="edit-form-name-ar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button form="edit-form" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.edit-modal -->
@endsection

@section('scripts')
    <script>
        $('.edit-btn').click(function() {
            let id = $(this).attr('data-id')
            let nameEn = $(this).attr('data-name-en')
            let nameAr = $(this).attr('data-name-ar')

            $('#edit-form-id').val(id)
            $('#edit-form-name-en').val(nameEn)
            $('#edit-form-name-ar').val(nameAr)
        })
    </script>
@endsection
