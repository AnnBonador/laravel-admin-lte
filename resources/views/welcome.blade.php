@extends('layouts.frontend')
@section('section')
    <!-- Home Banner -->
    <section class="section section-search">
        <div class="container-fluid">
            <div class="banner-wrapper">
                <div class="banner-header text-center">
                    <h1>Make an Appointment</h1>
                    <p>Discover the best doctors and clinics</p>
                </div>

            </div>
        </div>
    </section>
    <!-- /Home Banner -->

    <!-- Popular Section -->
    <section class="section section-doctor">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-header ">
                        <h2>Book Now</h2>
                    </div>
                    <div class="about-content">
                        <p>Our entire dental team is dedicated to providing you with the personalized, gentle care that you
                            deserve. Located in the heart of Metro Manila, SMILEs is proud to offer Implant and
                            Advanced General Dentistry to our patients. Our dental office proudly serve patients who come
                            see us for their routine dental care and cosmetic treatments from all over the world.</p>
                        <p>Part of our commitment to serving our patients includes providing information that helps you to
                            make more informed decisions about your oral health needs. </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="doctor-slider slider">

                        @foreach (getClinics() as $data)
                            <!-- Doctor Widget -->
                            <div class="profile-widget">
                                <div class="doc-img">
                                    <a href="doctor-profile.html">
                                        @if (!empty($data->image))
                                            <img class="img-fluid" alt="User Image"
                                                src="{{ asset('uploads/clinic/' . $data->image) }}">
                                        @else
                                            <img src="{{ asset('admin-assets/dist/img/default.png') }}" class="img-fluid"
                                                alt="clinic Image">
                                        @endif
                                    </a>
                                </div>
                                <div class="pro-content">
                                    <h3 class="title">
                                        <a href="doctor-profile.html">{{ $data->name }}</a>
                                        <i class="fas fa-check-circle verified"></i>
                                    </h3>
                                    <p class="speciality">{{ implode(', ', $data->specialization_id) }}</p>
                                    <ul class="available-info">
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $data->address . ', ' . $data->country . ', ' . $data->city }}
                                        </li>
                                        <li>
                                            <i class="far fa-envelope"></i> {{ $data->email }}
                                        </li>
                                        <li>
                                            <i class="fas fa-phone"></i> {{ $data->contact }}
                                        </li>
                                    </ul>
                                    <div class="row row-sm">
                                        <div class="col-6">
                                            <a href="{{ route('clinics.profile', $data->id) }}" class="btn view-btn">View
                                                Profile</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('login') }}" class="btn book-btn">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Doctor Widget -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Popular Section -->
@endsection
