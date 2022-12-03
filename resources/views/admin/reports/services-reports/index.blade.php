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
                <form method="get">
                    <div class="row">
                        <div class="col-3 form-group">
                            <label class="control-label" for="y">Year</label>
                            <select name="y" id="y" class="custom-select">
                                @foreach (array_combine(range(date('Y'), 1900), range(date('Y'), 1900)) as $year)
                                    <option value="{{ $year }}" @if ($year === old('y', Request::get('y', date('Y')))) selected @endif>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 form-group">
                            <label class="control-label" for="m">Month</label>
                            <select name="m" for="m" class="custom-select">
                                @foreach (cal_info(0)['months'] as $month)
                                    <option value="{{ $month }}" @if ($month === old('m', Request::get('m', date('m')))) selected @endif>
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="control-label">&nbsp;</label><br>
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                Services Report
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Top Availed Services by Category</th>
                                                <th>Earnings</th>
                                            </tr>
                                            @foreach ($service_category as $data)
                                                <tr>
                                                    <td>
                                                        {{ $data->name }}
                                                    </td>
                                                    <td>{{ number_format($data->earnings, 2, '.', ',') }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Top Availed Procedures</th>
                                                <th></th>
                                            </tr>
                                            @foreach ($procedures as $data)
                                                <tr>
                                                    <td>
                                                        {{ $data->name }}
                                                    </td>
                                                    <td>{{ $data->count }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
