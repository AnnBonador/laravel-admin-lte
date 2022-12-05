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
                                <input type="text" class="form-control" name="search"
                                    value="{{ Request::get('search') }}" placeholder="Search Doctors, Services Etc.">
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
                                            <input type="checkbox" name="proximity">
                                            <span class="checkmark"></span> Proximity
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="ratings">
                                            <span class="checkmark"></span> Ratings
                                        </label>
                                        <input type="hidden" name="latitude" id="lat" value="">
                                        <input type="hidden" name="longitude" id="long" value="">
                                    </div>
                                </div>
                                <div class="btn-search">
                                    <button type="submit" class="btn btn-block">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Search Filter -->

                </div>

                <div class="col-md-12 col-lg-8 col-xl-9">

                    @foreach ($doctors as $data)
                        <div class="card">
                            <div class="card-body">
                                <div class="doctor-widget">
                                    <div class="doc-info-left">
                                        <div class="doctor-img">
                                            @if (!empty($data->image))
                                                <a href="{{ route('doctor.profile', $data->id) }}">
                                                    <img src="{{ asset('uploads/doctor/' . $data->image) }}"
                                                        class="img-fluid" alt="User Image">
                                                </a>
                                            @else
                                                <a href="{{ route('doctor.profile', $data->id) }}">
                                                    <img src="{{ asset('admin-assets/dist/img/default.png') }}"
                                                        class="img-fluid" alt="User Image">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="doc-info-cont">
                                            <h4 class="doc-name"><a
                                                    href="{{ route('doctor.profile', $data->id) }}">{{ $data->full_name }}
                                                </a>
                                            </h4>
                                            <p class="doc-speciality">
                                                @if (!empty($data->specialization_id))
                                                    {{ implode(', ', $data->specialization_id) }}
                                                @endif
                                            </p>
                                            <h5 class="doc-department"><img
                                                    src="{{ asset('front-assets/assets/img/specialities/specialities-05.png') }}"
                                                    class="img-fluid" alt="Speciality">Dentist</h5>
                                            <div class="rating">
                                                @if (!empty($data->ratings))
                                                    <?php $rating = $data->average_rating; ?>
                                                    @foreach (range(1, 5) as $i)
                                                        <span class="fa-stack" style="width:1em">
                                                            <i class="far fa-star fa-stack-1x"></i>
                                                            @if ($rating > 0)
                                                                @if ($rating > 0.5)
                                                                    <i class="fas fa-star fa-stack-1x text-warning"></i>
                                                                @else
                                                                    <i
                                                                        class="fas fa-star-half fa-stack-1x text-warning"></i>
                                                                @endif
                                                            @endif
                                                            @php $rating--; @endphp
                                                        </span>
                                                    @endforeach
                                                    <span
                                                        class="d-inline-block">{{ number_format($data->average_rating, 1, '.', ',') }}</span>
                                                @endif
                                            </div>
                                            <div class="clinic-details">
                                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                                    {{ $data->address . ' ' . $data->city . ', ' . $data->country }}
                                                </p>
                                            </div>
                                            <div class="clinic-services">
                                                @if ($data->service)
                                                    @foreach ($data->service as $s)
                                                        <span>{{ $s->name }}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="doc-info-right">
                                        <div class="clini-infos">
                                            <ul>
                                                @php
                                                    $miles = $data->distance;
                                                    $meter = 1.609344 * $miles;
                                                @endphp
                                                <li>{{ round($meter, 1) }} km</li>
                                                <li><i class="far fa-comment"></i>
                                                    @if ($data->ratings)
                                                        {{ $data->ratings->count() ?: '0' }}
                                                    @endif
                                                    Feedback
                                                </li>
                                                <li><i class="fas fa-envelope"></i>{{ $data->email }}</li>
                                                <li><i class="fas fa-phone"></i>{{ $data->contact }}</li>
                                                <li><i
                                                        class="fas fa-map-marker-alt"></i>{{ $data->city . ', ' . $data->country }}
                                            </ul>
                                        </div>
                                        <div class="clinic-booking">
                                            <a class="view-pro-btn" href="{{ route('doctor.profile', $data->id) }}">View
                                                Profile</a>
                                        </div>
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
@section('scripts')
    <script>
        //getting location
        var lat = document.getElementById("lat");
        var long = document.getElementById("long");
        var x = document.getElementById("demo");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }

        function showPosition(position) {
            console.log(position);
            $('#lat').val(position.coords.latitude);
            $('#long').val(position.coords.longitude);
        }
    </script>
@endsection
