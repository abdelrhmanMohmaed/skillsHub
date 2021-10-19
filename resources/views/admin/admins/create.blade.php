@extends('admin.layout')

@section('title')
    Add New Admin
@endsection
@section('main')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add New Admin</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard/admins') }}">Admins</a></li>
                            <li class="breadcrumb-item active">Add Admins</li>
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
                    <div class="col-12 pb-3">

                        @include('admin.inc.errors')

                        <form method="POST" action="{{ url("/dashboard/admins/store") }}">
                            @csrf

                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>E-Mail</label>
                                            <input class="form-control" type="text" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Confirm Password </label>
                                            <input class="form-control" type="password" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="custom-select form-control" name="role_id">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="float-right">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection
