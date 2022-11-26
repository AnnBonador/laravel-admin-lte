@extends('layouts.frontend')
@section('section')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Doctor Profile</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <!-- Doctor Widget -->
            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                @if (!empty($data->image->count))
                                    <img src="{{ asset('uploads/doctor/' . $doctor->image) }}" class="img-fluid"
                                        alt="User Image">
                                @else
                                    <img src="{{ asset('admin-assets/dist/img/default.png') }}" class="img-fluid"
                                        alt="User Image">
                                @endif
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">{{ $doctor->full_name }}</h4>
                                <p class="doc-speciality">{{ $doctor->specialty->name }}</p>
                                <p class="doc-department"><img
                                        src="{{ asset('front-assets/assets/img/specialities/specialities-05.png') }}"
                                        class="img-fluid" alt="Speciality">Dentist</p>
                                <div class="rating">
                                    @if (!empty($ratings->count()))
                                        @php
                                            $score_total = $five_stars * 5 + $four_stars * 4 + $three_stars * 3 + $two_stars * 2 + $one_star * 1;
                                            $five_star_score = $score_total / $ratings->count();
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @php
                                                $checkstar = $five_star_score - $i;
                                            @endphp
                                            @if ($checkstar >= $i)
                                                <i class="fas fa-star filled"></i>
                                            @else
                                                <i class="fas fa-star"></i>
                                            @endif
                                        @endfor
                                    @else
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    @endif

                                    <span class="d-inline-block average-rating">({{ $ratings->count() }})</span>
                                </div>
                                <div class="clinic-details">
                                    <p class="doc-location">{{ $doctor->degree }}</p>
                                </div>
                                <div class="clinic-services">
                                    @foreach ($doctor->service as $data)
                                        <li>{{ $data->name }}</li>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clini-infos">
                                <ul>
                                    <li><i class="far fa-comment"></i> {{ $ratings->count() }} Feedback</li>
                                    <li><i class="fas fa-map-marker-alt"></i>{{ $doctor->city . ', ' . $doctor->country }}
                                    </li>
                                </ul>
                            </div>
                            <div class="clinic-booking">
                                <a class="apt-btn" href="{{ route('user.appointments.create') }}">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Doctor Widget -->

            <!-- Doctor Details Tab -->
            <div class="card">
                <div class="card-body pt-0">

                    <!-- Tab Menu -->
                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /Tab Menu -->

                    <!-- Tab Content -->
                    <div class="tab-content pt-0">

                        <!-- Overview Content -->
                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-12 col-lg-9">

                                    <!-- About Details -->
                                    <div class="widget about-widget">
                                        <h4 class="widget-title">About Me</h4>
                                        <p>{{ $doctor->about }}</p>
                                    </div>
                                    <!-- /About Details -->

                                    <!-- Education Details -->
                                    <div class="widget education-widget">
                                        <h4 class="widget-title">Education</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                <li>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#/" class="name">{{ $doctor->college }}</a>
                                                            <div>{{ $doctor->degree }}</div>
                                                            {{-- <span class="time">1998 - 2003</span> --}}
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Education Details -->


                                    <!-- Services List -->
                                    <div class="service-list">
                                        <h4>Services</h4>
                                        <ul class="clearfix">

                                            @foreach ($services as $data)
                                                <li>{{ $data->name }}</li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <!-- /Services List -->

                                </div>
                            </div>
                        </div>
                        <!-- /Overview Content -->


                        <!-- Reviews Content -->
                        <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                            <!-- Review Listing -->
                            <div class="widget review-listing">
                                <ul class="comments-list">

                                    <!-- Comment List -->
                                    @if (!empty($reviews->count()))
                                        @foreach ($reviews as $data)
                                            <!-- Comment List -->
                                            <li>
                                                <div class="comment">
                                                    <img class="avatar avatar-sm rounded-circle" alt="User Image"
                                                        src="{{ asset('uploads/patient/' . $data->patients->image) }}">
                                                    <div class="comment-body">
                                                        <div class="meta-data">
                                                            <span
                                                                class="comment-author">{{ $data->patients->full_name }}</span>
                                                            <span class="comment-date">Reviewed
                                                                {{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>

                                                            <div class="review-count rating"
                                                                style="position: relative !important">
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star filled"></i>
                                                                <i class="fas fa-star"></i>
                                                            </div>

                                                        </div>
                                                        <p class="comment-content">
                                                            {{ $data->comments }}
                                                        </p>
                                                        <div class="comment-reply">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- /Comment List -->
                                        @endforeach
                                    @else
                                        <p>No reviews</p>
                                    @endif

                                </ul>

                            </div>
                            <!-- /Review Listing -->

                        </div>
                        <!-- /Reviews Content -->

                        <!-- Business Hours Content -->
                        <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">

                                    <!-- Business Hours Widget -->
                                    <div class="widget business-widget">
                                        <div class="widget-content">
                                            <div class="listing-hours">
                                                @foreach ($schedule as $data)
                                                    <div class="listing-day">
                                                        <div class="day">
                                                            {{ \Carbon\Carbon::parse($data->day)->toFormattedDateString() }}
                                                        </div>
                                                        <div class="time-items">
                                                            <span
                                                                class="time">{{ $data->start_time . ' - ' . $data->end_time }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Business Hours Widget -->

                                </div>
                            </div>
                        </div>
                        <!-- /Business Hours Content -->

                    </div>
                </div>
            </div>
            <!-- /Doctor Details Tab -->
        @endsection
