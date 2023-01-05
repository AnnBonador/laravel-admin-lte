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
            <div class="row">
                <div class="col-md-4">
                    <form action="{{ route('medical.show.report') }}" method="GET" id="filtersForm">
                        <div class="input-group">
                            <input type="text" name="from-to" class="form-control mr-2" id="date_filter">
                            <span class="input-group-btn">
                                <input type="submit" class="btn btn-primary" value="Filter">
                            </span>
                        </div>
                    </form>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <table class="table table-sm bg-white">
                            <tr>
                                <th>Category</th>
                                <th>#</th>
                            </tr>
                            <tr>
                                <th>Patient Registration</th>
                                <td>{{ $results_patients }}</td>
                            </tr>
                            <tr>
                                <th>Number Of Appointment Treated</th>
                                <td>{{ $results_treated }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('medical.print.report') }}" class="btn btn-success">Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            let searchParams = new URLSearchParams(window.location.search)
            let dateInterval = searchParams.get('from-to');
            let start = moment().subtract(29, 'days');
            let end = moment();
            if (dateInterval) {
                dateInterval = dateInterval.split(' - ');
                start = dateInterval[0];
                end = dateInterval[1];
            }
            $('#date_filter').daterangepicker({
                "showDropdowns": true,
                "showWeekNumbers": true,
                "alwaysShowCalendars": true,
                startDate: start,
                endDate: end,
                locale: {
                    format: 'YYYY-MM-DD',
                    firstDay: 1,
                },
                ranges: {
                    'Today': [moment(), moment().add(1, 'days')],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
                        .endOf('year')
                    ],
                    'All time': [moment().subtract(30, 'year').startOf('month'), moment().endOf('month')],
                }
            });
        });
    </script>
@endsection
