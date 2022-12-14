@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Doctor</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Doctor</li>
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
                        <div class="card-header">Doctor Edit
                            <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('doctors.update', $doctor->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row mb-4">
                                    <div class="form-group col-sm-4">
                                        <label for="">First Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="fname" value="{{ $doctor->fname }}"
                                            class="form-control" placeholder="Enter first name">
                                        @if ($errors->has('fname'))
                                            <span class="text-danger text-left">{{ $errors->first('fname') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Last Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="lname" value="{{ $doctor->lname }}"
                                            class="form-control" placeholder="Enter last name">
                                        @if ($errors->has('lname'))
                                            <span class="text-danger text-left">{{ $errors->first('lname') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email" value="{{ $doctor->email }}"
                                            class="form-control" placeholder="Enter email address">
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    @role('Clinic Admin')
                                        <input type="hidden" name="clinic_id" value="{{ $doctor->clinic_id }}">
                                    @endrole
                                    @role('Receptionist')
                                        <input type="hidden" name="clinic_id" value="{{ $doctor->clinic_id }}">
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
                                                        {{ $doctor->clinic_id == $id ? 'selected' : '' }}>
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
                                        <input type="text" name="contact" value="{{ substr($doctor->contact, 3) }}"
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
                                                data-target="#dob" placeholder="mm/dd/yyyy" value="{{ $doctor->dob }}" />
                                            <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if ($errors->has('dob'))
                                            <span class="text-danger text-left">{{ $errors->first('dob') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <label for="">Specialization</label>
                                        <span class="text-danger">*</span>
                                        <select name="specialization_id[]" class="select2bs4" data-placeholder="Search"
                                            data-allow-clear="true" multiple="multiple" style="width: 100%;">
                                            <option value=""></option>
                                            @foreach ($specialize as $item)
                                                <option value="{{ $item }}"
                                                    {{ in_array($item, $doctor->specialization_id ?: []) ? 'selected' : '' }}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('specialization_id'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('specialization_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Experience</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="experience" value="{{ $doctor->experience }}"
                                            class="form-control" placeholder="Enter year(s) of experience"
                                            id="num">
                                        @if ($errors->has('experience'))
                                            <span class="text-danger text-left">{{ $errors->first('experience') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Status</label>
                                        <span class="text-danger">*</span>
                                        <select name="status" class="custom-select">
                                            <option value="1" {{ $doctor->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $doctor->status == '0' ? 'selected' : '' }}>Inactive
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
                                                {{ $doctor->gender == 'Male' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Female"
                                                id="female" name="gender"
                                                {{ $doctor->gender == 'Female' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="female">Female</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Others"
                                                id="others" name="gender"
                                                {{ $doctor->gender == 'Others' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="others">Others</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Profile Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <input type="hidden" value="{{ $doctor->image }}" name="old_image">
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2">
                                    <div class="form-group col-sm-12">
                                        <label for="">Address</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="address" value="{{ $doctor->address }}"
                                            class="form-control" placeholder="Enter address">
                                        @if ($errors->has('address'))
                                            <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Country</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="country" value="{{ $doctor->country }}"
                                            class="form-control" placeholder="Enter country name">
                                        @if ($errors->has('country'))
                                            <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">City</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="city" value="{{ $doctor->city }}"
                                            class="form-control" placeholder="Enter city">
                                        @if ($errors->has('city'))
                                            <span class="text-danger text-left">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2">
                                    <div class="form-group col-sm-6">
                                        <label for="">Latitude</label>
                                        <input type="text" name="latitude" value="{{ $doctor->latitude }}"
                                            class="form-control" placeholder="Enter latitude">
                                        @if ($errors->has('latitude'))
                                            <span class="text-danger text-left">{{ $errors->first('latitude') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Longitude</label>
                                        <input type="text" name="longitude" value="{{ $doctor->longitude }}"
                                            class="form-control" placeholder="Enter longitude">
                                        @if ($errors->has('longitude'))
                                            <span class="text-danger text-left">{{ $errors->first('longitude') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2">
                                    <div class="form-group col-sm-4">
                                        <label for="">Degree</label>
                                        <input type="text" name="degree" value="{{ $doctor->degree }}"
                                            class="form-control" placeholder="Enter degree">
                                        @if ($errors->has('degree'))
                                            <span class="text-danger text-left">{{ $errors->first('degree') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">College/University</label>
                                        <input type="text" name="college" value="{{ $doctor->college }}"
                                            class="form-control" placeholder="Enter college">
                                        @if ($errors->has('college'))
                                            <span class="text-danger text-left">{{ $errors->first('college') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Year completion</label>
                                        <input type="text" name="year" value="{{ $doctor->year }}"
                                            class="form-control" placeholder="Enter year completion" id="num">
                                        @if ($errors->has('year'))
                                            <span class="text-danger text-left">{{ $errors->first('year') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">About</label>
                                        <textarea name="about" class="form-control" rows="3">{{ $doctor->about }}</textarea>
                                        @if ($errors->has('about'))
                                            <span class="text-danger text-left">{{ $errors->first('about') }}</span>
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
