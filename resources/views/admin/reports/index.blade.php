@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reports</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reports</li>
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
                    <div class="my-2">
                        <form action="{{ route('reports') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="start_date">
                                <input type="date" class="form-control" name="end_date">
                                <button class="btn btn-primary" type="submit">GET</button>
                            </div>
                        </form>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Reviews</h3>
                        </div>
                        <div class="card-body">
                            <table id="table1" class="table table-borderless table-hover" style="width:100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Doctor Name</th>
                                        <th>Ratings</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($reviews as $data)
                                        <tr>
                                            <td>{{ $data->patients->full_name }}</td>
                                            <td>{{ $data->doctors->full_name }}</td>

                                            <td>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($data->star_rating >= $i)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="fas fa-star text-secondary"></i>
                                                    @endif
                                                @endfor
                                            </td>
                                            <td>{{ $data->comments }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d h:i A') }}</td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
