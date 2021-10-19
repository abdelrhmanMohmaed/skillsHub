@extends('admin.layout')

@section('title')
    Messages
@endsection
@section('main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Messages</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard/messages') }}">All Messages</a></li>
                            <li class="breadcrumb-item active">Messages</li>
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
                                <h3 class="card-title">Messages Show</h3>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">

                                    <tbody>

                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $message->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $message->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Subject</th>
                                            <td>{{ $message->subject ?? '...' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Body</th>
                                            <td>{{ $message->body }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Send Response</h3>
                            </div>

                            <div class="card-body  p-0">
                                @include('admin.inc.errors')
                                <form method="POST" action="{{ url("/dashboard/messages/response/$message->id") }}">
                                    @csrf

                                    <div class="card-body ">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input class="form-control" type="text" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label>Body</label>
                                            <textarea class="form-control" row="5" name="body"></textarea>
                                        </div>
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
