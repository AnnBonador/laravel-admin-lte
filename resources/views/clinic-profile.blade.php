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
                            <li class="breadcrumb-item active" aria-current="page">Clinic Profile</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Clinic Profile</h2>
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
                                <img src="{{ asset('uploads/clinic/' . $clinic->image) }}" class="img-fluid"
                                    alt="User Image">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">{{ $clinic->name }}</h4>
                                <p class="doc-speciality">{{ $clinic->email }}<br>
                                    {{ $clinic->contact }}</p>
                                <div class="clinic-details">
                                    <p class="doc-location"><i
                                            class="fas fa-map-marker-alt"></i>&nbsp;{{ $clinic->address . ', ' . $clinic->country . ', ' . $clinic->city }}
                                    </p>
                                    <ul class="clinic-gallery">
                                        {{-- <li>
                                            <a href="assets/img/features/feature-01.jpg" data-fancybox="gallery">
                                                <img src="assets/img/features/feature-01.jpg" alt="Feature">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="assets/img/features/feature-04.jpg" data-fancybox="gallery">
                                                <img src="assets/img/features/feature-04.jpg" alt="Feature">
                                            </a>
                                        </li> --}}
                                    </ul>
                                </div>
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
                                <a class="nav-link" href="#doc_locations" data-toggle="tab">Doctors</a>
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

                                    <!-- Services List -->
                                    <div class="service-list">
                                        <h4>Services</h4>
                                        <ul class="clearfix">
                                            @foreach ($services as $data)
                                                <li>{{ $data->name }} </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <!-- /Services List -->

                                    <!-- Specializations List -->
                                    <div class="service-list">
                                        <h4>Specializations</h4>
                                        <ul class="clearfix">
                                            @foreach ($clinic->specialization_id as $data)
                                                <li>{{ $data }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /Specializations List -->

                                </div>
                            </div>
                        </div>
                        <!-- /Overview Content -->

                        <!-- Locations Content -->
                        <div role="tabpanel" id="doc_locations" class="tab-pane fade">

                            @foreach ($doctors as $data)
                                <!-- Location List -->
                                <div class="location-list">
                                    <div class="row">

                                        <!-- Clinic Content -->
                                        <div class="col-md-6">
                                            <div class="clinic-content">
                                                <div class="doc-info-left">
                                                    <div class="doctor-img">
                                                        @if (!empty($data->image))
                                                            <a href="{{ route('doctor.profile', $data->id) }}">
                                                                <img src="{{ asset('uploads/doctor/' . $data->image) }}"
                                                                    class="img-fluid" alt="User Image">
                                                            </a>
                                                        @else
                                                            <img src="{{ asset('admin-assets/dist/img/default.png') }}"
                                                                class="img-fluid" alt="User Image">
                                                        @endif
                                                    </div>
                                                    <div class="doc-info-cont">
                                                        <h4 class="doc-name"><a
                                                                href="{{ route('doctor.profile', $data->id) }}">{{ $data->full_name }}</a>
                                                        </h4>
                                                        <p class="doc-speciality">{{ $data->specialty->name }}</p>
                                                        <h5 class="doc-department"><img
                                                                src="{{ asset('front-assets/assets/img/specialities/specialities-05.png') }}"
                                                                class="img-fluid" alt="Speciality">Dentist</h5>
                                                        <div class="rating">

                                                            {{-- @for ($i = 1; $i <= 5; $i++)
                                                                @if ($data->ratings->star_rating >= $i)
                                                                    <i class="fas fa-star filled"></i>
                                                                @else
                                                                    <i class="fas fa-star"></i>
                                                                @endif
                                                            @endfor --}}

                                                            <span class="d-inline-block average-rating">
                                                                @foreach ($data->ratings as $val)
                                                                    {{ $val->ratings()->avg() }}
                                                                @endforeach

                                                            </span>
                                                        </div>
                                                        <div class="clinic-details">
                                                            <p class="doc-location"><i class="far fa-envelope"></i>
                                                                {{ $data->email }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Clinic Content -->
                                    </div>
                                </div>
                            @endforeach
                            <!-- /Location List -->

                        </div>
                        <!-- /Locations Content -->

                    </div>
                </div>
            </div>
            <!-- /Doctor Details Tab -->

        </div>
    </div>
    <!-- /Page Content -->
@endsection
