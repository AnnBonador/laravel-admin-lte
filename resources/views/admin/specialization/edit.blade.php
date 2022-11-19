@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Specialization</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Specialization</li>
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
                        <div class="card-header">Specialization Edit
                            <a href="{{ route('specialization.index') }}" class="btn btn-sm btn-danger float-right">
                                Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')

                            <form action="{{ route('specialization.update', $specialization->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-2">
                                    <div class="form-group col-sm-8">
                                        <label for="">Specialization Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ $specialization->name }}"
                                            class="form-control" placeholder="Enter name">
                                        @if ($errors->has('name'))
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
