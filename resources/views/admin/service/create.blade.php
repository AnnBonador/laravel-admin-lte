@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Services</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Services</li>
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
                        <div class="card-header">Service Create
                            <a href="{{ route('services.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('services.store') }}" method="POST">
                                @csrf
                                @role('Doctor')
                                    <input type="hidden" name="doctor_id" value="{{ Auth::id() }}">
                                @endrole
                                <div class="row mb-4">
                                    <div class="form-group col-sm-4">
                                        <label for="">Service category</label>
                                        <span class="text-danger">*</span>
                                        <select name="service_cid" data-placeholder="Search" data-allow-clear="true"
                                            class="form-control select2bs4" style="width: 100%;">
                                            <option selected="selected"></option>
                                            @foreach ($service_cat as $id => $item)
                                                <option value="{{ $id }}"
                                                    {{ old('service_cid') == $id ? 'selected' : '' }}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('service_cid'))
                                            <span class="text-danger text-left">{{ $errors->first('service_cid') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Service Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" placeholder="Enter service name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Charges</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₱</span>
                                            </div>
                                            <input type="text" name="charges"id="num" class="form-control"
                                                value="{{ old('charges') }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                        @if ($errors->has('charges'))
                                            <span class="text-danger text-left">{{ $errors->first('charges') }}</span>
                                        @endif
                                    </div>
                                    @hasanyrole('Super-Admin|Clinic Admin|Receptionist')
                                        <div class="form-group col-sm-4">
                                            <label for="">Select Doctor</label>
                                            <span class="text-danger">*</span>
                                            <select name="doctor_id" data-placeholder="Search" data-allow-clear="true"
                                                class="form-control select2bs4" style="width: 100%;">
                                                <option selected="selected"></option>
                                                @foreach ($doctor as $id => $item)
                                                    <option value="{{ $id }}"
                                                        {{ old('doctor_id') == $id ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('doctor_id'))
                                                <span class="text-danger text-left">{{ $errors->first('doctor_id') }}</span>
                                            @endif
                                        </div>
                                    @endhasanyrole
                                    <div class="form-group col-sm-4">
                                        <label>Status</label>
                                        <span class="text-danger">*</span>
                                        <select name="status" class="custom-select">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
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
