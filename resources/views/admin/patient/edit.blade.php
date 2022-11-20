@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Patients</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Patients</li>
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
                        <div class="card-header">Patient Edit
                            <a href="{{ route('patients.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('patients.update', $patient->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row mb-4">
                                    <div class="form-group col-sm-4">
                                        <label for="">First Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="fname" value="{{ $patient->fname }}"
                                            class="form-control" placeholder="Enter first name">
                                        @if ($errors->has('fname'))
                                            <span class="text-danger text-left">{{ $errors->first('fname') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Last Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="lname" value="{{ $patient->lname }}"
                                            class="form-control" placeholder="Enter last name">
                                        @if ($errors->has('lname'))
                                            <span class="text-danger text-left">{{ $errors->first('lname') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email" value="{{ $patient->email }}"
                                            class="form-control" placeholder="Enter email address">
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    @role('Clinic Admin')
                                        <input type="hidden" name="clinic_id" value="{{ $patient->clinic_id }}">
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
                                                        {{ $patient->clinic_id == $id ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('clinic_id'))
                                                <span class="text-danger text-left">{{ $errors->first('clinic_id') }}</span>
                                            @endif
                                        </div>
                                    @endrole
                                    <div class="form-group col-sm-4">
                                        <label for="">Contact No.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="contact" value="{{ substr($patient->contact, 3) }}"
                                            class="form-control js-phone" placeholder="Enter contact number">
                                        @if ($errors->has('contact'))
                                            <span class="text-danger text-left">{{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Birthday</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group date" id="dob" data-target-input="nearest">
                                            <input name="dob" type="text" class="form-control datetimepicker-input"
                                                data-target="#dob" placeholder="mm/dd/yyyy" value="{{ $patient->dob }}" />
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
                                            <option value="1" {{ $patient->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $patient->status == '0' ? 'selected' : '' }}>Inactive
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
                                            <input class="custom-control-input" type="radio" value="Male"
                                                id="male" name="gender"
                                                {{ $patient->gender == 'Male' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Female"
                                                id="female" name="gender"
                                                {{ $patient->gender == 'Female' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="female">Female</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Others"
                                                id="others" name="gender"
                                                {{ $patient->gender == 'Others' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="others">Others</label>
                                        </div>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Profile Image</label>
                                        <input type="file" name="image">
                                        <input type="hidden" value="{{ $patient->image }}" name="old_image">
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2">
                                    <div class="form-group col-sm-12">
                                        <label for="">Address</label>
                                        <input type="text" name="address" value="{{ $patient->address }}"
                                            class="form-control" placeholder="Enter address">
                                        @if ($errors->has('address'))
                                            <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Country</label>
                                        <input type="text" name="country" value="{{ $patient->country }}"
                                            class="form-control" placeholder="Enter country name">
                                        @if ($errors->has('country'))
                                            <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">City</label>
                                        <input type="text" name="city" value="{{ $patient->city }}"
                                            class="form-control" placeholder="Enter city">
                                        @if ($errors->has('city'))
                                            <span class="text-danger text-left">{{ $errors->first('city') }}</span>
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
