@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('body')
    <!-- Main row -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">Settings
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('services.store') }}" method="POST">
                                @csrf
                                <div class="row mb-4">
                                    <div class="form-group col-sm-6">
                                        <label for="">System Information</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" placeholder="Enter system name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Title</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="title" value="{{ old('title') }}"
                                            class="form-control" placeholder="Enter title">
                                        @if ($errors->has('title'))
                                            <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Footer</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="footer" value="{{ old('footer') }}"
                                            class="form-control" placeholder="Enter footer">
                                        @if ($errors->has('footer'))
                                            <span class="text-danger text-left">{{ $errors->first('footer') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="footer" value="{{ old('email') }}"
                                            class="form-control" placeholder="Enter email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Logo</label>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <img style="width: 100px" height="100px" src="" alt="">
                                            </div>
                                            <input type="file" class="form-control" name="logo">
                                            <input type="hidden" value="" name="old_logo">
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label>Favicon </label>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <img style="width: 32px" height="32px" src="" alt="">
                                            </div>
                                            <input type="file" class="form-control" name="icon">
                                            <input type="hidden" value="" name="old_icon">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection
