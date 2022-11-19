@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                            <h3 class="card-title">User Edit</h3>
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mt-2">
                                    <div class="form-group col-sm-4">
                                        <label for="">First Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="fname_admin" class="form-control"
                                            placeholder="Enter first name" value="{{ $user->fname }}">
                                        @if ($errors->has('fname_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('fname_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Last Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="lname_admin" class="form-control"
                                            placeholder="Enter last name" value="{{ $user->fname }}">
                                        @if ($errors->has('lname_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('lname_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email_admin" class="form-control"
                                            placeholder="Enter email address" value="{{ $user->email }}">
                                        @if ($errors->has('email_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('email_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Contact No.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="contact_admin" class="form-control js-phone"
                                            placeholder="Enter contact number" value="{{ substr($user->contact, 3) }}">
                                        @if ($errors->has('contact_admin'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('contact_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Birthday</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group date" id="dob" data-target-input="nearest">
                                            <input name="dob" type="text" class="form-control datetimepicker-input"
                                                data-target="#dob" value="{{ $user->dob }}" placeholder="mm/dd/yyyy" />
                                            <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if ($errors->has('dob'))
                                            <span class="text-danger text-left">{{ $errors->first('dob') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Status</label>
                                        <span class="text-danger">*</span>
                                        <select name="status" class="custom-select">
                                            <option value=""> Select a status</option>
                                            <option value="1" {{ $user->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Gender</label>
                                        <span class="text-danger">*</span>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Male" id="male"
                                                name="gender" {{ $user->gender == 'Male' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Female" id="female"
                                                name="gender" {{ $user->gender == 'Female' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="female">Female</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Others"
                                                id="others" name="gender"
                                                {{ $user->gender == 'Others' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="others">Others</label>
                                        </div>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Role</label>
                                        {!! Form::select('roles[]', $roles, $userRole, ['class' => 'custom-select']) !!}
                                        @if ($errors->has('roles'))
                                            <span class="text-danger text-left">{{ $errors->first('roles') }}</span>
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
