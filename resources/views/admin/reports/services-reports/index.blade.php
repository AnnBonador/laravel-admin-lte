@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Medical Report</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Medical Report</li>
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
            <div class="col-md-12">
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Top Services</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>Services</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($count as $data)
                                            <tr>
                                                <td>
                                                    {{ $data->name }}
                                                </td>
                                                <td>{{ $data->total_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
