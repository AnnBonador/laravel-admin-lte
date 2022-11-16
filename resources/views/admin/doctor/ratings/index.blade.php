@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Doctors Ratings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Doctors Ratings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('body')
    <!-- Main row -->
    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <a href="{{ route('doctors.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Reviews</h4>
                                            @foreach ($ratings as $data)
                                                <div class="post">
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm"
                                                            src="{{ asset('uploads/patient/' . $data->patients->image) }}">
                                                        <span class="username">
                                                            <a href="#">{{ $data->patients->full_name }}</a>
                                                        </span>
                                                        <span class="description">
                                                            {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                                                        </span>
                                                    </div>

                                                    <div class="rated">
                                                        @for ($i = 1; $i <= $data->star_rating; $i++)
                                                            <input type="radio" id="star{{ $i }}"
                                                                class="rate" name="rating" value="5" />
                                                            <label class="star-rating-complete"
                                                                title="text">{{ $i }} stars</label>
                                                        @endfor
                                                    </div>
                                                    <input type="hidden" name="booking_id" value="{{ $data->id }}">
                                                    <div class="row">
                                                        <p>{{ $data->comments }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                    <p class="">
                                        <strong class="text-left">Rating Breakdown</strong>
                                        <span class="float-right text-muted">{{ $ratings->count() }} reviews</span>
                                    </p>
                                    <div class="progress-group">Excellent (5)
                                        <span class="float-right"><b>{{ $five_stars }}</b></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                        </div>
                                    </div>

                                    <div class="progress-group">
                                        Good (4)
                                        <span class="float-right"><b>{{ $four_stars }}</b></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                    </div>

                                    <div class="progress-group">
                                        <span class="progress-text">Average (3)</span>
                                        <span class="float-right"><b>{{ $three_stars }}</b></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-info" style="width: 1%"></div>
                                        </div>
                                    </div>

                                    <div class="progress-group">
                                        Poor (2)
                                        <span class="float-right"><b>{{ $two_stars }}</b></span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-warning" style="width: 50%"></div>
                                        </div>
                                    </div>
                                    <div class="progress-group mb-4">
                                        Terrible (1)
                                        <span class="float-right"><b>{{ $one_star }}</span>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar bg-danger" style="width: 50%"></div>
                                        </div>
                                    </div>
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Average
                                                User Rating</span>
                                            <h4 class="info-box-number text-center text-primary mb-0">4.7 / 5</h4>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    <!-- /.row (main row) -->
@endsection
