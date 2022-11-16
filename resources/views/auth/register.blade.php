@extends('layouts.authentication')

@section('body')
    <div class="register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="../../index2.html"><b>Admin</b>LTE</a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Register a new membership</p>

                    @include('layouts.partials.messages')

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="first_name" placeholder="Enter first name"
                                value="{{ old('first_name') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="last_name" placeholder="Enter last name"
                                value="{{ old('last_name') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control js-phone" name="contact"
                                placeholder="Enter contact number" value="{{ substr(old('contact'), 3) }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group date" id="dob" data-target-input="nearest">
                                <input name="birthday" type="text" class="form-control datetimepicker-input"
                                    data-target="#dob" placeholder="mm/dd/yyyy" value="{{ old('dob') }}" />
                                <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" value="Male" id="male"
                                    name="gender" {{ old('gender') == 'Male' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="male">Male</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" value="Female" id="female"
                                    name="gender" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="female">Female</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" value="Others" id="others"
                                    name="gender" {{ old('gender') == 'Others' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="others">Others</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Retype password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <a href="login.html" class="text-center">I already have a membership</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
    </div>
    <!-- /.register-box -->
@endsection
