@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles</li>
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
                            <h3 class="card-title">Roles Edit</h3>
                            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')

                            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row mb-2">
                                    <div class="form-group col-sm-8">
                                        <label for=""> Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ $role->name }}"
                                            class="form-control" placeholder="Enter name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="d-inline mb-2">
                                        <strong>Permissions: </strong>
                                        <label><input type="checkbox" id="select-all" /> Check
                                            all</label>
                                    </div>
                                    @foreach ($permission->chunk(4) as $four)
                                        <div class="row">
                                            @foreach ($four as $value)
                                                <div class="col-md-3">
                                                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                                        {{ $value->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    {{-- @foreach ($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                            {{ $value->name }}</label>
                                        <br />
                                    @endforeach --}}
                                </div>

                                <button class="btn btn-secondary" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection
