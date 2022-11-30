@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Payment Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payment Settings</li>
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
                        <div class="card-header">Create Paypal
                            <a href="{{ route('paypal.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('paypal.store') }}" method="POST">
                                @csrf

                                <div class="row mb-2">
                                    @hasanyrole('Clinic Admin|Receptionist')
                                        <input type="hidden" name="clinic_id" value="{{ auth()->user()->clinic_id }}">
                                    @endrole
                                    @role('Super-Admin')
                                        <div class="form-group col-sm-4">
                                            <label for="">Select Clinic</label>
                                            <span class="text-danger">*</span>
                                            <select name="clinic_id" data-placeholder="Search" data-allow-clear="true"
                                                class="form-control select2bs4" style="width: 100%;">
                                                <option selected="selected"></option>
                                                @foreach ($clinic as $id => $item)
                                                    <option value="{{ $id }}"
                                                        {{ old('clinic_id') == $id ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('clinic_id'))
                                                <span class="text-danger text-left">{{ $errors->first('clinic_id') }}</span>
                                            @endif
                                        </div>
                                    @endrole
                                    <div class="form-group col-sm-5">
                                        <label for="">Username</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="username" value="{{ old('username') }}"
                                            class="form-control" placeholder="Enter username">
                                        @if ($errors->has('username'))
                                            <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="">Password</label>
                                        <span class="text-danger">*</span>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                            class="form-control" placeholder="Enter password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <label for="">Secret</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="secret" value="{{ old('secret') }}"
                                            class="form-control" placeholder="Enter secret code">
                                        @if ($errors->has('secret'))
                                            <span class="text-danger text-left">{{ $errors->first('secret') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Currency</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="currency" value="{{ old('currency') }}"
                                            class="form-control" placeholder="Enter currency">
                                        @if ($errors->has('currency'))
                                            <span class="text-danger text-left">{{ $errors->first('currency') }}</span>
                                        @endif
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
