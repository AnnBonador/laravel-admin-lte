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
                            <li class="breadcrumb-item active" aria-current="page">Search Results</li>
                        </ol>
                    </nav>
                    </nav>
                    <!-- Search -->
                    <div class="search-box mt-2">
                        <form action="{{ route('clinic.result.search') }}" method="GET">
                            <div class="form-group search-info">
                                <input type="text" class="form-control" name="search"
                                    value="{{ Request::get('search') }}"
                                    id="input-search"placeholder="Search Doctors, Services Etc.">
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
                            <form action="{{ route('clinic.filter.search') }}" method="GET">
                                <div class="filter-widget">
                                    <h4>Sort</h4>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="proximity" class="checkFilter">
                                            <span class="checkmark"></span> Proximity
                                        </label>
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
                    @if (count($results) > 0)
                        <h4 class="breadcrumb-title">{{ $results->count() }} matches found</h4>
                        @foreach ($results as $data)
                            @if (class_basename($data) == 'Clinic')
                                <div class="card">
                                    <div class="card-body">
                                        <div class="clinic-content">
                                            <h4 class="clinic-name"><a
                                                    href="{{ route('clinics.profile', $data->id) }}">{{ $data->name }}</a>
                                            </h4>
                                            <p class="doc-speciality">{{ $data->email }}</p>

                                            <div class="clinic-details mb-0">
                                                <h5 class="clinic-direction">
                                                    {{ $data->address . ', ' . $data->city . ', ' . $data->country }}<br>
                                                    {{ $data->contact }}</h5>
                                            </div>
                                            <div class="clinic-services">
                                                @foreach ($data->specialization_id as $speciality)
                                                    <span>{{ $speciality }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <h2 class="breadcrumb-title">No matches found</h2>
                    @endif


                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
@endsection
