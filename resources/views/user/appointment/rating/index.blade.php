@extends('layouts.user')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rate Doctor</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Rate Doctor</li>
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
            @if (!empty($review->star_rating))
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-4">
                                <p class="font-weight-bold ">Review</p>
                                <div class="form-group row">
                                    <input type="hidden" value="{{ $review->id }}">
                                    <div class="col">
                                        <div class="rated">
                                            @for ($i = 1; $i <= $review->star_rating; $i++)
                                                <input type="radio" id="star{{ $i }}" class="rate"
                                                    name="star_rating" value="5" />
                                                <label class="star-star_rating-complete" title="text">{{ $i }}
                                                    stars</label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <div class="col">
                                        <p>{{ $review->comments }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-4">
                                <form class="py-2 px-4" action="{{ route('user.review.store') }}" method="POST"
                                    autocomplete="off">
                                    @csrf
                                    <p class="font-weight-bold ">Review</p>
                                    <div class="form-group row">
                                        <input type="hidden" name="app_id" value="{{ $appointment->id }}">
                                        <input type="hidden" name="patient" value="{{ $appointment->patient_id }}">
                                        <input type="hidden" name="doctor" value="{{ $appointment->doctor_id }}">
                                        <div class="col">
                                            <div class="rate">
                                                <input type="radio" id="star5" class="rate" name="star_rating"
                                                    value="5" />
                                                <label for="star5" title="text">5 stars</label>
                                                <input type="radio" checked id="star4" class="rate"
                                                    name="star_rating" value="4" />
                                                <label for="star4" title="text">4 stars</label>
                                                <input type="radio" id="star3" class="rate" name="star_rating"
                                                    value="3" />
                                                <label for="star3" title="text">3 stars</label>
                                                <input type="radio" id="star2" class="rate" name="star_rating"
                                                    value="2">
                                                <label for="star2" title="text">2 stars</label>
                                                <input type="radio" id="star1" class="rate" name="star_rating"
                                                    value="1" />
                                                <label for="star1" title="text">1 star</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-4">
                                        <div class="col">
                                            <textarea class="form-control" name="comments" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-3 text-right">
                                        <button class="btn btn-sm py-2 px-3 btn-info">Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
    <!-- /.row (main row) -->
@endsection
