@extends('layouts.user')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Checkout</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
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
            <form action="{{ route('user.appointments.step.three.post') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        @include('layouts.partials.messages')
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Personal Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <label for="">First Name</label>
                                        <input type="text" name="first_name" class="form-control"
                                            placeholder="Enter first name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="">Last Name</label>
                                        <input type="text" name="last_name" class="form-control"
                                            placeholder="Enter last name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="">Phone</label>
                                        <input type="text" name="contact" class="form-control"
                                            placeholder="Enter phone number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Booking Summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul class="list-group mb-2">
                                            @foreach ($app_service as $data)
                                                <li class="list-group-item">
                                                    <b>{{ $data->name }}</b> <span class="float-right text-muted">₱
                                                        {{ $data->charges }}.00</span>
                                                </li>
                                            @endforeach
                                            <li class="list-group-item">
                                                <b>Booking Fee</b> <span class="float-right text-muted">₱ 25.00</span>
                                            </li>
                                            @php
                                                $total_services = $app_service->sum('charges');
                                                $total = 15 + $total_services;
                                            @endphp
                                            <li class="list-group-item">
                                                <b class="fs-5 fw-bolder">Total</b> <b class="float-right text-primary">₱
                                                    {{ $total }}.00</b>
                                            </li>
                                        </ul>
                                        <button type="submit" class="btn btn-block btn-flat btn-success">Continue to
                                            Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection
