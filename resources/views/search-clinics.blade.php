@extends('layouts.frontend')
@section('section')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-10 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Search</li>
                        </ol>
                    </nav>
                    </nav>
                    <!-- Search -->
                    <div class="search-box mt-2">
                        <form action="{{ route('doctor.result.search') }}" method="GET">
                            <div class="form-group search-info">
                                <input type="text" class="form-control" name="search" placeholder="Search Clinics">
                            </div>
                            <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i>
                                <span>Search</span></button>
                        </form>
                    </div>
                    <!-- /Search -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <p id="demo" class="d-none"></p>
                <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Search Filter -->
                    <div class="card search-filter">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Search Filter</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('doctor.filter.search') }}" method="GET">
                                <div class="filter-widget">
                                    <h4>Sort</h4>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="proximity" class="checkFilter">
                                            <span class="checkmark"></span> Proximity
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="ratings" class="checkFilter">
                                            <span class="checkmark"></span> Ratings
                                        </label>
                                        <input type="hidden" name="latitude" id="lat" value="">
                                        <input type="hidden" name="longitude" id="long" value="">
                                    </div>
                                </div>
                                <div class="btn-search">
                                    <button type="submit" id="filter" disabled="true"
                                        class="btn btn-block">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Search Filter -->

                </div>

                <div class="col-md-12 col-lg-8 col-xl-9">

                    @foreach ($clinics as $data)
                        <div class="card">
                            <div class="card-body">
                                <div class="clinic-content">
                                    <h4 class="clinic-name"><a href="#">{{ $data->name }}</a></h4>
                                    <p class="doc-speciality">{{ $data->email }}</p>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">(4)</span>
                                    </div>
                                    <div class="clinic-details mb-0">
                                        <h5 class="clinic-direction"> <i class="fas fa-map-marker-alt"></i>
                                            {{ $data->address }}, {{ $data->city }}, {{ $data->country }} <br><a
                                                href="javascript:void(0);">Get
                                                Directions</a></h5>
                                        <ul>
                                            <li>
                                                <a href="assets/img/features/feature-01.jpg" data-fancybox="gallery2">
                                                    <img src="assets/img/features/feature-01.jpg" alt="Feature Image">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="assets/img/features/feature-02.jpg" data-fancybox="gallery2">
                                                    <img src="assets/img/features/feature-02.jpg" alt="Feature Image">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="assets/img/features/feature-03.jpg" data-fancybox="gallery2">
                                                    <img src="assets/img/features/feature-03.jpg" alt="Feature Image">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="assets/img/features/feature-04.jpg" data-fancybox="gallery2">
                                                    <img src="assets/img/features/feature-04.jpg" alt="Feature Image">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="clinic-services">
                                        @foreach ($data->specialization_id as $speciality)
                                            <span>{{ $speciality }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
@endsection
