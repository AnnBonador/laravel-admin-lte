@extends('layouts.admin')

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
                        <div class="card-header">Clinic Create
                            <a href="{{ route('clinics.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('clinics.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4">
                                    <div class="form-group col-sm-4">
                                        <label for="">Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control" placeholder="Enter clinic name">
                                        @if ($errors->has('name'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control" placeholder="Enter email address">
                                        @if ($errors->has('email'))
                                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Contact No.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="contact" value="{{ substr(old('contact'), 3) }}"
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
                                                    {{ in_array($item, old('specialization_id') ?: []) ? 'selected' : '' }}>
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
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
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
                                        <input type="text" name="address" value="{{ old('address') }}"
                                            class="form-control" placeholder="Enter address">
                                        @if ($errors->has('address'))
                                            <span class="text-danger text-left">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Country</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="country" value="{{ old('country') }}"
                                            class="form-control" placeholder="Enter country name">
                                        @if ($errors->has('country'))
                                            <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">City</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="city" value="{{ old('city') }}"
                                            class="form-control" placeholder="Enter city">
                                        @if ($errors->has('city'))
                                            <span class="text-danger text-left">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Clinic Image</label>
                                        <input type="file" name="clinic_image" class="form-control">
                                        @if ($errors->has('clinic_image'))
                                            <span class="text-danger">{{ $errors->first('clinic_image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-2">
                                    <div class="form-group col-sm-6">
                                        <label for="">Latitude</label>
                                        <input type="text" name="latitude" value="{{ old('latitude') }}"
                                            class="form-control" placeholder="Enter latitude">
                                        @if ($errors->has('latitude'))
                                            <span class="text-danger text-left">{{ $errors->first('latitude') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Longitude</label>
                                        <input type="text" name="longitude" value="{{ old('longitude') }}"
                                            class="form-control" placeholder="Enter longitude">
                                        @if ($errors->has('longitude'))
                                            <span class="text-danger text-left">{{ $errors->first('longitude') }}</span>
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
                                            placeholder="Enter first name" value="{{ old('fname_admin') }}">
                                        @if ($errors->has('fname_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('fname_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Last Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="lname_admin" class="form-control"
                                            placeholder="Enter last name" value="{{ old('lname_admin') }}">
                                        @if ($errors->has('lname_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('lname_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" name="email_admin" class="form-control"
                                            placeholder="Enter email address" value="{{ old('email') }}">
                                        @if ($errors->has('email_admin'))
                                            <span class="text-danger text-left">{{ $errors->first('email_admin') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Contact No.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="contact_admin" class="form-control js-phone"
                                            placeholder="Enter contact number" value="{{ substr(old('contact'), 3) }}">
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
                                                value="{{ old('dob') }}" placeholder="mm/dd/yyyy" />
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
                                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="Others" {{ old('gender') == 'Others' ? 'selected' : '' }}>
                                                Others</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="text-danger text-left">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Admin Profile Image</label>
                                        <input type="file" name="admin_image" class="form-control">
                                        @if ($errors->has('admin_image'))
                                            <span class="text-danger">{{ $errors->first('admin_image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="row mt-2">
                                    <label for="">Featured Image</label>
                                    <form method="post" action="{{ url('dropzone/store') }}"
                                        enctype="multipart/form-data" class="dropzone" id="dropzone">
                                        @csrf
                                    </form>
                                </div> --}}
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
@section('scripts')
    <script type="text/javascript">
        Dropzone.options.dropzone = {
            maxFilesize: 10,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 60000,
            success: function(file, response) {
                console.log(response);
            },
            error: function(file, response) {
                return false;
            }
        };
    </script>
@endsection
