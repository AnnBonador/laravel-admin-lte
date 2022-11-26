@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Appointment</li>
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
                        <div class="card-header">Appointment Edit
                            <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-sm-5">
                                        @role('Doctor')
                                            <input type="hidden" id="get_doctor_id" value="{{ $appointment->doctor_id }}">
                                        @endrole
                                        @role('Super-Admin')
                                            <div class="form-group">
                                                <label for="">Select Clinic</label>
                                                <span class="text-danger">*</span>
                                                <select name="clinic_id" data-placeholder="Search" data-allow-clear="true"
                                                    class="form-control select2bs4" style="width: 100%;" id="load_clinic"
                                                    disabled="disabled">
                                                    <option selected="selected"></option>
                                                    @foreach ($clinic as $id => $item)
                                                        <option value="{{ $id }}"
                                                            {{ $appointment->clinic_id == $id ? 'selected' : '' }}>
                                                            {{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('clinic_id'))
                                                    <span class="text-danger text-left">{{ $errors->first('clinic_id') }}</span>
                                                @endif
                                            </div>
                                        @endrole
                                        @hasanyrole('Super-Admin|Clinic Admin|Receptionist')
                                            <div class="form-group">
                                                <label for="">Select Doctor</label>
                                                <span class="text-danger">*</span>
                                                <input type="hidden" id="get_doctor_id" value="{{ $appointment->doctor_id }}">
                                                <select name="doctor_id" data-placeholder="Search" data-allow-clear="true"
                                                    class="form-control select2bs4" style="width: 100%;" id="load_doctor"
                                                    disabled="disabled">
                                                    @foreach ($doctor as $id => $item)
                                                        <option value="{{ $id }}"
                                                            {{ $appointment->doctor_id == $id ? 'selected' : '' }}>
                                                            {{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('doctor_id'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->first('doctor_id') }}</span>
                                                @endif
                                            </div>
                                        @endhasanyrole
                                        <div class="form-group">
                                            <label for="">Select Service</label>
                                            <span class="text-danger">*</span>
                                            <a href="{{ route('services.create') }}" class="float-right text-sm">Add
                                                service</a>
                                            <select name="service[]" multiple="multiple" data-placeholder="Search"
                                                data-allow-clear="true" class="form-control select2bs4" style="width: 100%;"
                                                id="load_service" disabled="disabled">
                                                @foreach ($service as $item)
                                                    <option value="{{ $item }}"
                                                        {{ in_array($item, $appointment->service ?: []) ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('service'))
                                                <span class="text-danger text-left">{{ $errors->first('service') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="">Select Schedule</label>
                                            <span class="text-danger">*</span>
                                            <select name="schedule_id" data-placeholder="Search" data-allow-clear="true"
                                                class="form-control select2bs4" style="width: 100%;" id="load_date">
                                                @foreach ($schedule as $id => $item)
                                                    <option value="{{ $id }}"
                                                        {{ $appointment->schedule_id == $id ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('schedule_id'))
                                                <span
                                                    class="text-danger text-left">{{ $errors->first('schedule_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="">Select Patient</label>
                                            <span class="text-danger">*</span>
                                            <a href="{{ route('patients.create') }}" class="float-right text-sm">Add
                                                patient</a>
                                            <select name="patient_id" data-placeholder="Search" data-allow-clear="true"
                                                class="form-control select2bs4" style="width: 100%;" disabled="disabled">
                                                <option selected="selected"></option>
                                                @foreach ($patients as $id => $item)
                                                    <option value="{{ $id }}"
                                                        {{ $appointment->patient_id == $id ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('patient_id'))
                                                <span
                                                    class="text-danger text-left">{{ $errors->first('patient_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <span class="text-danger">*</span>
                                            <select name="status" class="custom-select">
                                                <option value="Booked"
                                                    {{ $appointment->status == 'Booked' ? 'selected' : '' }}>
                                                    Booked
                                                </option>
                                                <option value="Check in"
                                                    {{ $appointment->status == 'Check in' ? 'selected' : '' }}>Check in
                                                </option>
                                                <option value="Check out"
                                                    {{ $appointment->status == 'Check out' ? 'selected' : '' }}>Check out
                                                </option>
                                                <option value="Cancelled"
                                                    {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled
                                                </option>
                                                <option value="Completed"
                                                    {{ $appointment->status == 'Completed' ? 'selected' : '' }}>
                                                    Completed
                                                </option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label for="">Available Slot </label>
                                            <span class="text-danger">*</span>
                                            <input type="hidden" id="get_time_value" name="time">
                                            <div class="text-center" id="load_slots">
                                                <span class="fw-lighter d-none" id="no"></span>
                                                <input type="radio" class="btn-check" name="booking_id" id=""
                                                    value="" autocomplete="off">
                                                <label class="btn btn-outline-primary fw-normal m-2"
                                                    for="">{{ $appointment->start_time . ' - ' . $appointment->end_time }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <textarea name="description" class="form-control" rows="2" placeholder="Enter appointment description">{{ $appointment->description }}</textarea>
                                        </div>
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
        //get time slots am and pm
        $(document).on('click', 'input[name="booking_id"]', function() {
            $('#get_time_value').val(this.nextSibling.textContent);
        });
        //getting doctors
        $(document).ready(function() {
            $('#load_clinic').on('change', function(e) {
                var clinic_id = e.target.value;
                $('#load_slots').empty();
                $('#load_date').empty();
                $("#load_service").val([]).change();
                if (clinic_id) {
                    $.ajax({
                        url: "{{ route('getDoctor') }}",
                        type: "POST",
                        data: {
                            clinic_id: clinic_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            $('#load_doctor').empty();
                            $('#load_doctor').append(
                                '<option value=""> Select Doctor</option>');
                            $.each(data, function(key, value) {
                                $('#load_doctor').append($(
                                    "<option/>", {
                                        value: key,
                                        text: value
                                    }));

                            });
                        }
                    })
                } else {
                    $('#load_doctor').empty();
                    $("#load_service").val([]).change();
                    $('#load_slots').empty();
                }
            });

            //getting service
            $('#load_doctor').on('change', function(e) {
                var doctor_id = e.target.value;
                $('#load_slots').empty();
                $('#load_date').empty();
                $("#load_service").val([]).change();
                if (doctor_id) {
                    $.ajax({
                        url: "{{ route('getService') }}",
                        type: "POST",
                        data: {
                            doctor_id: doctor_id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            $('#load_service').empty();
                            $('#load_service').append(
                                '<option value=""> Select Service</option>');
                            $.each(data.services, function(key, value) {
                                $('#load_service').append($(
                                    "<option/>", {
                                        value: value,
                                        text: value
                                    }));

                            });
                            $('#load_date').empty();
                            $('#load_date').append(
                                '<option value=""> Select Date</option>');
                            $.each(data.date_id, function(key, value) {
                                $('#load_date').append($(
                                    "<option/>", {
                                        value: key,
                                        text: value
                                    }));

                            });
                            $('#get_doctor_id').val(doctor_id);
                        }
                    })
                } else {
                    $("#load_service").val([]).change();
                    $('#load_slots').empty();

                }
            });

            //getting time slots
            $('#load_date').on('change', function(e) {
                $('#load_slots').empty();
                var slots = $(this).val();
                var doctor_id = $('#get_doctor_id').val();
                $.ajax({
                    url: "{{ route('getSlots') }}",
                    type: "POST",
                    data: {
                        slots: slots,
                        doctor_id: doctor_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {

                        $.each(data, function(key, value) {
                            $('#load_slots').append(
                                '<input type="radio" class="btn-check" name="booking_id" id="' +
                                key +
                                '"  value="' + key +
                                '" autocomplete="off"><label class="btn btn-outline-primary fw-normal m-2"for="' +
                                key + '">' + value + '</label>');
                        });

                    },
                })
            })

        });
    </script>
@endsection
