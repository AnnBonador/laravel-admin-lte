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
                                    placeholder="Search Doctors, Services Etc.">
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

                    {{-- @foreach ($users as $doctor)
                        <!-- Doctor Widget -->
                        <div class="card">
                            <div class="card-body">
                                <div class="doctor-widget">
                                    <div class="doc-info-left">
                                        <div class="doctor-img">
                                            <a href="doctor-profile.html">
                                                <img src="assets/img/doctors/doctor-thumb-01.jpg" class="img-fluid"
                                                    alt="User Image">
                                            </a>
                                        </div>

                                        @php
                                            $miles = $doctor->distance;
                                            $meter = 1.609344 * $miles;
                                        @endphp
                                        <div class="doc-info-cont">
                                            <h4 class="doc-name"><a href="doctor-profile.html">
                                                    {{ $doctor->fname . ' ' . $doctor->lname }}
                                                </a></h4>
                                            <p class="doc-speciality">{{ round($meter, 1) }} km</p>
                                            <h5 class="doc-department"><img
                                                    src="assets/img/specialities/specialities-05.png" class="img-fluid"
                                                    alt="Speciality">Dentist</h5>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(17)</span>
                                            </div>
                                            <div class="clinic-details">
                                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i> Florida, USA
                                                </p>
                                                <ul class="clinic-gallery">
                                                    <li>
                                                        <a href="assets/img/features/feature-01.jpg"
                                                            data-fancybox="gallery">
                                                            <img src="assets/img/features/feature-01.jpg" alt="Feature">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="assets/img/features/feature-02.jpg"
                                                            data-fancybox="gallery">
                                                            <img src="assets/img/features/feature-02.jpg" alt="Feature">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="assets/img/features/feature-03.jpg"
                                                            data-fancybox="gallery">
                                                            <img src="assets/img/features/feature-03.jpg" alt="Feature">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="assets/img/features/feature-04.jpg"
                                                            data-fancybox="gallery">
                                                            <img src="assets/img/features/feature-04.jpg" alt="Feature">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="clinic-services">
                                                <span>Dental Fillings</span>
                                                <span> Whitneing</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="doc-info-right">
                                        <div class="clini-infos">
                                            <ul>
                                                <li><i class="far fa-thumbs-up"></i> 98%</li>
                                                <li><i class="far fa-comment"></i> 17 Feedback</li>
                                                <li><i class="fas fa-map-marker-alt"></i> Florida, USA</li>
                                                <li><i class="far fa-money-bill-alt"></i> $300 - $1000 <i
                                                        class="fas fa-info-circle" data-toggle="tooltip"
                                                        title="Lorem Ipsum"></i> </li>
                                            </ul>
                                        </div>
                                        <div class="clinic-booking">
                                            <a class="view-pro-btn" href="doctor-profile.html">View Profile</a>
                                            <a class="apt-btn" href="booking.html">Book Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Doctor Widget -->
                    @endforeach --}}
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
                                                @if (!empty($data->reviews))
                                                    @php
                                                        $rating = $data->reviews->avg('star_rating');
                                                    @endphp
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($rating < $i)
                                                            @if (round($rating) == $i)
                                                                <i class="fas fa-star-half filled"></i>
                                                                @continue
                                                            @endif
                                                            <i class="fas fa-star"></i>
                                                            @continue
                                                        @endif
                                                        <i class="fas fa-star filled"></i>
                                                    @endfor
                                                    <span class="d-inline-block average-rating">
                                                        ({{ $data->reviews->count() }})
                                                    </span>
                                                @else
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                    <span class="d-inline-block average-rating">(0)</span>
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
                                                <li><i class="far fa-comment"></i>
                                                    @if ($data->reviews)
                                                        {{ $data->reviews->count() ?: '0' }}
                                                    @else
                                                        0
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
        var x = document.getElementById("demo");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }

        function showPosition(position) {
            console.log(position);
            x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
        }
    </script>
@endsection
