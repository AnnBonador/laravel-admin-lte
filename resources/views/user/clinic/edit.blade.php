@extends('layouts.user')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Clinic</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Clinic</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('body')
    <!-- Main row -->
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Check Out or Check In Clinic</h3>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('user.clinic.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4">
                                    <div class="form-inline">
                                        <label for="">Select Clinic</label>
                                        <span class="text-danger">*</span>
                                        <div class="form-group col-sm-4">
                                            <select name="clinic" data-placeholder="Search" data-allow-clear="true"
                                                class="form-control select2bs4" style="width: 100%;">
                                                <option selected="selected"></option>
                                                @foreach ($clinics as $id => $item)
                                                    <option value="{{ $id }}"
                                                        {{ Auth::user()->clinic_id == $id ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('clinic'))
                                                <span class="text-danger text-left">{{ $errors->first('clinic') }}</span>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection
