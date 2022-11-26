@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Doctor Schedule</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Doctor Schedule</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('body')
    <!-- Main row -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">Doctor Schedule Edit
                            <a href="{{ route('schedules.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="row mb-4">
                                    @role('Clinic Admin')
                                        <input type="hidden" name="clinic_id" value="{{ $schedule->clinic_id }}">
                                    @endrole
                                    @role('Doctor')
                                        <input type="hidden" name="doctor_id" value="{{ $schedule->doctor_id }}">
                                    @endrole
                                    @hasanyrole('Super-Admin|Doctor')
                                        <div class="form-group col-sm-4">
                                            <label for="">Select Clinic</label>
                                            <span class="text-danger">*</span>
                                            <select name="clinic_id" data-placeholder="Search" data-allow-clear="true"
                                                class="form-control select2bs4" style="width: 100%;" id="load_clinic">
                                                <option selected="selected"></option>
                                                @foreach ($clinic as $id => $item)
                                                    <option value="{{ $id }}"
                                                        {{ $schedule->clinic_id == $id ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('clinic_id'))
                                                <span class="text-danger text-left">{{ $errors->first('clinic_id') }}</span>
                                            @endif
                                        </div>
                                    @endhasanyrole
                                    @unlessrole('Doctor')
                                        <div class="form-group col-sm-4">
                                            <label for="">Select Doctor</label>
                                            <span class="text-danger">*</span>
                                            <select name="doctor_id" data-placeholder="Search" data-allow-clear="true"
                                                class="form-control select2bs4" style="width: 100%;" id="load_doctor">
                                                @foreach ($doctor as $id => $item)
                                                    <option value="{{ $id }}"
                                                        {{ $schedule->doctor_id == $id ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('doctor_id'))
                                                <span class="text-danger text-left">{{ $errors->first('doctor_id') }}</span>
                                            @endif
                                        </div>
                                    @endunlessrole
                                    <div class="form-group col-sm-4">
                                        <label>Duration (in minutes)</label>
                                        <span class="text-danger">*</span>
                                        <select name="duration" class="form-control">
                                            <option value="10" {{ $schedule->duration == '10' ? 'selected' : '' }}>10
                                            </option>
                                            <option value="20" {{ $schedule->duration == '20' ? 'selected' : '' }}>20
                                            </option>
                                            <option value="30" {{ $schedule->duration == '30' ? 'selected' : '' }}>30
                                            </option>
                                            <option value="40" {{ $schedule->duration == '40' ? 'selected' : '' }}>40
                                            </option>
                                            <option value="50" {{ $schedule->duration == '50' ? 'selected' : '' }}>50
                                            </option>
                                            <option value="60" {{ $schedule->duration == '60' ? 'selected' : '' }}>60
                                            </option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Date</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group date" id="apptDay" data-target-input="nearest">
                                            <input name="day" type="text" class="form-control datetimepicker-input"
                                                data-target="#apptDay" placeholder="mm/dd/yyyy"
                                                value="{{ $schedule->day }}" />
                                            <div class="input-group-append" data-target="#apptDay"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if ($errors->has('day'))
                                            <span class="text-danger text-left">{{ $errors->first('day') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Start Time</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group date" id="startTime" data-target-input="nearest">
                                            <input type="text" name="start_time" value="{{ $schedule->start_time }}"
                                                class="form-control datetimepicker-input" data-target="#startTime" />
                                            <div class="input-group-append" data-target="#startTime"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        @if ($errors->has('start_time'))
                                            <span class="text-danger text-left">{{ $errors->first('start_time') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">End Time</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group date" id="endTime" data-target-input="nearest">
                                            <input type="text" name="end_time"
                                                class="form-control datetimepicker-input" data-target="#endTime"
                                                value="{{ $schedule->end_time }}" />
                                            <div class="input-group-append" data-target="#endTime"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                        @if ($errors->has('end_time'))
                                            <span class="text-danger text-left">{{ $errors->first('end_time') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row (main row) -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#load_clinic').on('change', function(e) {
                var clinic_id = e.target.value;
                if (clinic_id) {
                    $.ajax({
                        url: "{{ route('getDoctor') }}",
                        type: "POST",
                        data: {
                            clinic_id: clinic_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data) {
                                $('#load_doctor').empty();
                                $('#load_doctor').append(
                                    '<option value=""> Select Doctor</option>');
                                $.each(data.doctors, function(key, value) {
                                    $('#load_doctor').append($(
                                        "<option/>", {
                                            value: key,
                                            text: value
                                        }));

                                });
                            } else {
                                $('#load_doctor').empty();
                            }
                        }
                    })
                } else {
                    $('#load_doctor').empty();
                }
            });
        });
    </script>
@endsection
