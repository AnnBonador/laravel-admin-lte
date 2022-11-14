@extends('admin.main-layout')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Clinics</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Clinics</li>
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
                        <div class="card-header">Clinic Edit
                            <a href="{{ route('clinics.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('clinics.update', $clinic->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="row mb-4">
                                    <div class="form-group col-sm-4">
                                        <label for="">Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ $clinic->name }}"
                                            class="form-control" placeholder="Enter clinic name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email" value="{{ $clinic->email }}"
                                            class="form-control" placeholder="Enter email address">
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Contact No.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="contact" value="{{ substr($clinic->contact, 3) }}"
                                            class="form-control js-phone" placeholder="Enter contact number">
                                        @if ($errors->has('contact'))
                                            <span class="text-danger text-left">{{ $errors->first('contact') }}</span>
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
                                                    {{ in_array($item, $clinic->specialization_id ?: []) ? 'selected' : '' }}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('specialization_id'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('specialization_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Status</label>
                                        <span class="text-danger">*</span>
                                        <select name="status" class="custom-select">
                                            <option value=""> Select a status</option>
                                            <option value="1" {{ $clinic->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ $clinic->status == '0' ? 'selected' : '' }}>Inactive
                                            </option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2">
                                    <div class="form-group col-sm-12">
                                        <label for="">Address</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="address" value="{{ $clinic->address }}"
                                            class="form-control" placeholder="Enter address">
                                        @if ($errors->has('address'))
                                            <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Country</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="country" value="{{ $clinic->country }}"
                                            class="form-control" placeholder="Enter country name">
                                        @if ($errors->has('country'))
                                            <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">City</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="city" value="{{ $clinic->city }}"
                                            class="form-control" placeholder="Enter city">
                                        @if ($errors->has('city'))
                                            <span class="text-danger text-left">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <h4 class="text-primary">Clinic Admin Panel</h4>
                                <div class="row mt-2">
                                    <div class="form-group col-sm-4">
                                        <label for="">First Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="fname_admin" class="form-control"
                                            value=@if ($clinic->users()->exists()) {{ $clinic->users->fname }} @endif
                                            placeholder="Enter first name">
                                        @if ($errors->has('fname_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('fname_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Last Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="lname_admin" class="form-control"
                                            value=@if ($clinic->users()->exists()) {{ $clinic->users->lname }} @endif
                                            placeholder="Enter last name">
                                        @if ($errors->has('lname_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('lname_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email_admin" class="form-control"
                                            value=@if ($clinic->users()->exists()) {{ $clinic->users->email }} @endif
                                            placeholder="Enter email address">
                                        @if ($errors->has('email_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('email_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Contact No.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="contact_admin" class="form-control js-phone"
                                            value=@if ($clinic->users()->exists()) {{ substr($clinic->users->contact, 3) }} @endif
                                            placeholder="Enter contact number">
                                        @if ($errors->has('contact_admin'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('contact_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Birthday</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group date" id="dob" data-target-input="nearest">
                                            <input name="dob" type="text"
                                                class="form-control datetimepicker-input" data-target="#dob"
                                                value=@if ($clinic->users()->exists()) {{ $clinic->users->dob }} @endif
                                                placeholder="mm/dd/yyyy" />
                                            <div class="input-group-append" data-target="#dob"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if ($errors->has('dob'))
                                            <span class="text-danger text-left">{{ $errors->first('dob') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Gender</label>
                                        <span class="text-danger">*</span>
                                        <select name="gender" class="custom-select">
                                            <option value="Male"
                                                @if ($clinic->users()->exists()) {{ $clinic->users->gender == 'Male' ? 'selected' : '' }} @endif>
                                                Male</option>
                                            <option value="Female"
                                                @if ($clinic->users()->exists()) {{ $clinic->users->gender == 'Female' ? 'selected' : '' }} @endif>
                                                Female</option>
                                            <option value="Others"
                                                @if ($clinic->users()->exists()) {{ $clinic->users->gender == 'Others' ? 'selected' : '' }} @endif>
                                                Others</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
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
