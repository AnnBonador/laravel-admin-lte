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
                            <form action="{{ route('update.clinic.profile', Auth::id()) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <b class="text-uppercase text-muted"> clinic information</b>
                                <div class="row mt-4 mb-4">
                                    <div class="form-group col-sm-6">
                                        <label for="">Clinic Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ $user->clinic->name }}"
                                            class="form-control" placeholder="Enter clinic name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email" value="{{ $user->clinic->email }}"
                                            class="form-control" placeholder="Enter email address">
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Contact No.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="contact" value="{{ substr($user->clinic->contact, 3) }}"
                                            class="form-control js-phone" placeholder="Enter contact number">
                                        @if ($errors->has('contact'))
                                            <span class="text-danger text-left">{{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Specialization</label>
                                        <span class="text-danger">*</span>
                                        <select name="specialization_id[]" class="select2bs4" data-placeholder="Search"
                                            data-allow-clear="true" multiple="multiple" style="width: 100%;">
                                            <option value=""></option>
                                            @foreach ($specialize as $item)
                                                <option value="{{ $item }}"
                                                    {{ in_array($item, $user->clinic->specialization_id ?: []) ? 'selected' : '' }}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('specialization_id'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('specialization_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <b class="text-uppercase text-muted">contact information</b>
                                <div class="row mt-4">
                                    <div class="form-group col-sm-12">
                                        <label for="">Address</label>
                                        <input type="text" name="address" value="{{ $user->clinic->address }}"
                                            class="form-control" placeholder="Enter address">
                                        @if ($errors->has('address'))
                                            <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Country</label>
                                        <input type="text" name="country" value="{{ $user->clinic->country }}"
                                            class="form-control" placeholder="Enter country name">
                                        @if ($errors->has('country'))
                                            <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">City</label>
                                        <input type="text" name="city" value="{{ $user->clinic->city }}"
                                            class="form-control" placeholder="Enter city">
                                        @if ($errors->has('city'))
                                            <span class="text-danger text-left">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Clinic Image</label>
                                        <input type="file" name="clinic_image" class="form-control">
                                        <input type="hidden" value="{{ $user->clinic->image }}" name="clinic_old_image">
                                        @if ($errors->has('clinic_image'))
                                            <span class="text-danger">{{ $errors->first('clinic_image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <b class="text-uppercase text-muted">clinic admin detail</b>
                                <div class="row mt-4">
                                    <div class="form-group col-sm-6">
                                        <label for="">First Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="fname_admin" class="form-control"
                                            placeholder="Enter first name" value="{{ $user->fname }}">
                                        @if ($errors->has('fname_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('fname_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Last Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="lname_admin" class="form-control"
                                            placeholder="Enter last name" value="{{ $user->lname }}">
                                        @if ($errors->has('lname_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('lname_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email_admin" class="form-control"
                                            placeholder="Enter email address" value="{{ $user->email }}">
                                        @if ($errors->has('email_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('email_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Contact No.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="contact_admin" class="form-control js-phone"
                                            placeholder="Enter contact number" value="{{ substr($user->contact, 3) }}">
                                        @if ($errors->has('contact_admin'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('contact_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Birthday</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group date" id="dob" data-target-input="nearest">
                                            <input name="dob" type="text"
                                                class="form-control datetimepicker-input" data-target="#dob"
                                                value="{{ $user->dob }}" placeholder="mm/dd/yyyy" />
                                            <div class="input-group-append" data-target="#dob"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if ($errors->has('dob'))
                                            <span class="text-danger text-left">{{ $errors->first('dob') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Gender</label>
                                        <span class="text-danger">*</span>
                                        <select name="gender" class="custom-select">
                                            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="Others" {{ $user->gender == 'Others' ? 'selected' : '' }}>
                                                Others</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Admin Profile Image</label>
                                        <input type="file" name="admin_image" class="form-control">
                                        <input type="hidden" value="{{ $user->image }}" name="admin_old_image">
                                        @if ($errors->has('admin_image'))
                                            <span class="text-danger">{{ $errors->first('admin_image') }}</span>
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
                                @if (!empty($user->clinic->image))
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('uploads/clinic/' . $user->clinic->image) }}"
                                        alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('admin-assets/dist/img/default.png') }}"
                                        alt="User profile picture">
                                @endif

                            </div>
                            <h3 class="profile-username text-center">{{ $user->clinic->name }}</h3>
                            <p class="text-muted text-center">{{ $user->clinic->email }}</p>
                            <div class="mt-2 text-center">
                                <b>{{ $user->clinic->address }}</b><br>
                                {{ implode(',', $user->clinic->specialization_id) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection
