@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">Edit Profile
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('update.doctor.profile', Auth::id()) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <b class="text-uppercase text-muted"> basic information</b>
                                <div class="row mt-4 mb-4">
                                    <div class="form-group col-sm-6">
                                        <label for="">First Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="fname" value="{{ $user->fname }}"
                                            class="form-control" placeholder="Enter first name">
                                        @if ($errors->has('fname'))
                                            <span class="text-danger text-left">{{ $errors->first('fname') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Last Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="lname" value="{{ $user->lname }}"
                                            class="form-control" placeholder="Enter last name">
                                        @if ($errors->has('lname'))
                                            <span class="text-danger text-left">{{ $errors->first('lname') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email" value="{{ $user->email }}"
                                            class="form-control" placeholder="Enter email address">
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Contact No.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="contact" value="{{ substr($user->contact, 3) }}"
                                            class="form-control js-phone" placeholder="Enter contact number">
                                        @if ($errors->has('contact'))
                                            <span class="text-danger text-left">{{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Birthday</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group date" id="dob" data-target-input="nearest">
                                            <input name="dob" type="text" class="form-control datetimepicker-input"
                                                data-target="#dob" placeholder="mm/dd/yyyy" value="{{ $user->dob }}" />
                                            <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if ($errors->has('dob'))
                                            <span class="text-danger text-left">{{ $errors->first('dob') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Specialization</label>
                                        <span class="text-danger">*</span>
                                        <select name="specialization_id" data-placeholder="Search" data-allow-clear="true"
                                            class="form-control select2bs4" style="width: 100%;">
                                            <option selected="selected"></option>
                                            @foreach ($specialize as $id => $item)
                                                <option value="{{ $id }}"
                                                    {{ $user->specialization_id == $id ? 'selected' : '' }}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('specialization_id'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('specialization_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Experience</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="experience" value="{{ $user->experience }}"
                                            class="form-control" placeholder="Enter year(s) of experience" id="num">
                                        @if ($errors->has('experience'))
                                            <span class="text-danger text-left">{{ $errors->first('experience') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Gender</label>
                                        <span class="text-danger">*</span>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Male"
                                                id="male" name="gender"
                                                {{ $user->gender == 'Male' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="male">Male</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Female"
                                                id="female" name="gender"
                                                {{ $user->gender == 'Female' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="female">Female</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" value="Others"
                                                id="others" name="gender"
                                                {{ $user->gender == 'Others' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="others">Others</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Profile Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <input type="hidden" value="{{ $user->image }}" name="old_image">
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <b class="text-uppercase text-muted"> qualification</b>
                                <div class="row mt-4">
                                    <div class="row mt-2">
                                        <div class="form-group col-sm-6">
                                            <label for="">Degree</label>
                                            <input type="text" name="degree" value="{{-- $doctor->degree --}}"
                                                class="form-control" placeholder="Enter degree">
                                            @if ($errors->has('degree'))
                                                <span class="text-danger text-left">{{ $errors->first('degree') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="">College/University</label>
                                            <input type="text" name="college" value="{{ $user->college }}"
                                                class="form-control" placeholder="Enter college">
                                            @if ($errors->has('college'))
                                                <span class="text-danger text-left">{{ $errors->first('college') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <b class="text-uppercase text-muted"> contact information</b>
                                <div class="row mt-4">
                                    <div class="form-group col-sm-12">
                                        <label for="">Address</label>
                                        <input type="text" name="address" value="{{ $user->address }}"
                                            class="form-control" placeholder="Enter address">
                                        @if ($errors->has('address'))
                                            <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Country</label>
                                        <input type="text" name="country" value="{{ $user->country }}"
                                            class="form-control" placeholder="Enter country name">
                                        @if ($errors->has('country'))
                                            <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">City</label>
                                        <input type="text" name="city" value="{{ $user->city }}"
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
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (!empty($user->image))
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('uploads/doctor/' . $user->image) }}" alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('admin-assets/dist/img/default.png') }}"
                                        alt="User profile picture">
                                @endif

                            </div>
                            <h3 class="profile-username text-center">{{ $user->full_name }}</h3>
                            <p class="text-muted text-center">{{ $user->email }}</p>
                            <div class="mt-2 text-center">
                                {{ $user->specialty->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection
