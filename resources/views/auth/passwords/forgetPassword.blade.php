@extends('layouts.authentication')
@section('body')
    <div class=" login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ route('home') }}"><b>{{ title() }}</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

                    @if (Session::has('message'))
                        <div class="alert alert-info" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    @include('layouts.partials.messages')

                    <form action="{{ route('forget.password.post') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mt-3 mb-1">
                        <a href="{{ route('login') }}">Login</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center">Register</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
    <!-- /.login-box -->
@endsection
