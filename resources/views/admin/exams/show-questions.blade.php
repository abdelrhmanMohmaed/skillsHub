@extends('admin.layout')

@section('title')
    {{ $exam->name('en') }} Questions
@endsection
@section('main')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $exam->name('en') }} Questions</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard/exams') }}">Exams</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ url("/dashboard/exams/show/$exam->id") }}">{{ $exam->name('en') }}</a></li>
                            <li class="breadcrumb-item active">Exams</li>
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
                    <div class="col-12 pd-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Exams Questions</h3>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Options</th>
                                            <th>Right Ans.</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exam->questions as $ques)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $ques->title }}</td>

                                                <td>{{ $ques->option_1 }} |<br>
                                                    {{ $ques->option_2 }} <br>
                                                    {{ $ques->option_3 }} |<br>
                                                    {{ $ques->option_4 }}
                                                    {{ $ques->option_4 }}
                                                </td>


                                                <td>{{ $ques->right_ans }}</td>
                                                <td>{{ $ques->questions_no }}</td>
                                                <td>
                                                   <a href="{{ url("dashboard/exams/edit-questions/$exam->id/$ques->id") }}"
                                                        class="btn btn-sm btn-info ">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{--  <a href="{{ url("dashboard/exams/delete/$exam->id") }}"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="{{ url("/dashboard/exams/toggle/$exam->id") }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Back</a>
                        <a href="{{ url('dashboard/exams') }}" class="btn btn-sm btn-primary">Back to all exams</a>
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
                    <h4 class="modal-title">Add New Skills</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    @include('admin.inc.errors')
                    </form>
                    <form method="post" action="{{ url('/dashboard/skills/store') }}" id="add-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (en)</label>
                                    <input type="text" name="name_en" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (ar)</label>
                                    <input type="text" name="name_ar" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="custom-select form-control" name="cat_id">
                                        @foreach ($cats as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name('en') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="img">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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


    <!-- .edit-modal -->
    {{-- <div class="modal fade" id="edit-modal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Skills</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    @include('admin.inc.errors')

                    <form method="post" action="{{ url('/dashboard/skills/update') }}" id="edit-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="edit-form-id">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (en)</label>
                                    <input type="text" name="name_en" class="form-control" id="edit-form-name-en">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Name (ar)</label>
                                    <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="custom-select form-control" id="edit-form-cat-id" name="cat_id">
                                        @foreach ($cats as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name('en') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="img">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    </div> --}}
    <!-- /.edit-modal -->
@endsection
