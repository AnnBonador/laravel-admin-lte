@extends('layouts.user')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Summary</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Summary</li>
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
                    @include('layouts.partials.messages')
                    <form action="{{ route('user.appointments.post.step.two') }}" method="POST">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="text-center text-primary">
                                    Summary
                                </h4>
                                <div class="row mt-4 m-4">
                                    <div class="col-sm-6">
                                        <label for="" class="text-primary">Appointment Info</label>
                                        <dl class="row">
                                            <dd class="col-sm-4">Date:</dd>
                                            <dt class="col-sm-8">{{ $app->schedule->day }}</dt>
                                            <dd class="col-sm-4">Time:</dd>
                                            <dt class="col-sm-8">{{ $app->start_time . ' - ' . $app->end_time }}</dt>
                                            <dd class="col-sm-4">Service:</dd>
                                            <dt class="col-sm-8">
                                                @foreach ($app_service as $service)
                                                    {{ $service->name }}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </dt>
                                            <dd class="col-sm-4">Doctor:</dd>
                                            <dt class="col-sm-8">{{ $app->doctors->full_name }}</dt>
                                            <dd class="col-sm-4">Clinic:</dd>
                                            <dt class="col-sm-8">{{ $app->clinic->name }}</dt>
                                            <dd class="col-sm-4">Charges:</dd>
                                            <dt class="col-sm-8"> ₱ {{ $app_service->sum('charges') }}</dt>
                                        </dl>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="" class="text-primary">Patient Info</label>
                                        <dl class="row">
                                            <dd class="col-sm-4">Patient name:</dd>
                                            <dt class="col-sm-8">{{ $app->patients->full_name }}</dt>
                                            <dd class="col-sm-4">Email:</dd>
                                            <dt class="col-sm-8">{{ $app->patients->email }}</dt>
                                            <dd class="col-sm-4">Contact:</dd>
                                            <dt class="col-sm-8">{{ $app->patients->contact }}</dt>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row mt-2 m-4">
                                    <div class="col-md-12 text-center">
                                        <h5 class="text-primary">
                                            Payment
                                        </h5>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" value="Cash"
                                                    id="cash" name="payment_option"
                                                    {{ old('payment_option') == 'Cash' ? 'checked' : '' }} required>
                                                <label class="custom-control-label" for="cash">Cash</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input class="custom-control-input" type="radio" value="Paypal"
                                                    id="paypal" name="payment_option"
                                                    {{ old('payment_option') == 'Paypal' ? 'checked' : '' }} required>
                                                <label class="custom-control-label" for="paypal">Paypal</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <a href="{{ route('user.appointments.create') }}"
                                            class="btn btn-danger pull-right">Cancel</a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection
