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
                                @if ($ratings->count() > 0)
                                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                        <div class="row">
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>Patient Reviews</h4>
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
                                        <div class="progress-group">
                                            <span class="progress-text">5 star</span>
                                            <span
                                                class="float-right"><b>{{ ($five_stars / $ratings->count()) * 100 }}%</b></span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    style="width:{{ ($five_stars / $ratings->count()) * 100 }}%"></div>
                                            </div>
                                        </div>

                                        <div class="progress-group">
                                            <span class="progress-text">4 star</span>
                                            <span
                                                class="float-right"><b>{{ ($four_stars / $ratings->count()) * 100 }}%</b></span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    style="width: {{ ($four_stars / $ratings->count()) * 100 }}%"></div>
                                            </div>
                                        </div>

                                        <div class="progress-group">
                                            <span class="progress-text">3 star</span>
                                            <span
                                                class="float-right"><b>{{ ($three_stars / $ratings->count()) * 100 }}%</b></span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    style="width: {{ ($three_stars / $ratings->count()) * 100 }}%"></div>
                                            </div>
                                        </div>

                                        <div class="progress-group">
                                            <span class="progress-text">2 star</span>
                                            <span class="float-right"><b>{{ ($two_stars / $ratings->count()) * 100 }}%
                                                </b></span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    style="width: {{ ($two_stars / $ratings->count()) * 100 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="progress-group mb-4">
                                            <span class="progress-text">1 star</span>
                                            <span
                                                class="float-right"><b>{{ ($one_star / $ratings->count()) * 100 }}%</span>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    style="width: {{ ($one_star / $ratings->count()) * 100 }}%"></div>
                                            </div>
                                        </div>
                                        @php
                                            $score_total = $five_stars * 5 + $four_stars * 4 + $three_stars * 3 + $two_stars * 2 + $one_star * 1;
                                            $five_star_score = $score_total / $ratings->count();
                                        @endphp
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Average
                                                    User Rating</span>
                                                <h4 class="info-box-number text-center text-primary mb-0">
                                                    {{ number_format($five_star_score, 1) }} /
                                                    5</h4>
                                            </div>
                                        </div>

                                    </div>
                                @else
                                    <div class="alert alert-light alert-dismissible">
                                        There are 0 reviews and 0 ratings
                                    </div>
                                @endif

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
