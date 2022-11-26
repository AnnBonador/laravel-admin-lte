@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Prescription</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Prescription</li>
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
                        <div class="card-header">Create Prescription
                            <a href="{{ route('prescription.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('prescription.store') }}" method="POST">
                                @csrf
                                <div class="row mb-4">
                                    @role('Clinic Admin')
                                        <input type="hidden" name="clinic_id" value="{{ Auth::user()->isClinicAdmin }}">
                                    @endrole
                                    @role('Doctor')
                                        <input type="hidden" name="doctor_id" value="{{ Auth::id() }}">
                                    @endrole
                                    @hasanyrole('Super-Admin|Doctor')
                                        <div class="form-group col-sm-4">
                                            <label for="">Clinic</label>
                                            <span class="text-danger">*</span>
                                            <select name="clinic_id" data-placeholder="Search" data-allow-clear="true"
                                                class="form-control select2bs4" style="width: 100%;" id="load_clinic">
                                                <option selected="selected"></option>
                                                @foreach ($clinic as $id => $item)
                                                    <option value="{{ $id }}"
                                                        {{ old('clinic_id') == $id ? 'selected' : '' }}>
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
                                            <label for="">Doctor</label>
                                            <span class="text-danger">*</span>
                                            <select name="doctor_id" data-placeholder="Search" data-allow-clear="true"
                                                class="form-control select2bs4" style="width: 100%;" id="load_doctor">
                                                @role('Clinic Admin')
                                                    <option value=""></option>
                                                    @foreach ($doctors as $id => $item)
                                                        <option value="{{ $id }}"
                                                            {{ old('doctor_id') == $id ? 'selected' : '' }}>
                                                            {{ $item }}</option>
                                                    @endforeach
                                                @endrole
                                            </select>
                                            @if ($errors->has('doctor_id'))
                                                <span class="text-danger text-left">{{ $errors->first('doctor_id') }}</span>
                                            @endif
                                        </div>
                                    @endunlessrole
                                    <div class="form-group col-sm-4">
                                        <label for="">Patient</label>
                                        <span class="text-danger">*</span>
                                        <select name="patient_id" data-placeholder="Search" data-allow-clear="true"
                                            class="form-control select2bs4" style="width: 100%;" id="load_patient">
                                            @role('Clinic Admin')
                                                <option value=""></option>
                                                @foreach ($patients as $id => $item)
                                                    <option value="{{ $id }}"
                                                        {{ old('patient_id') == $id ? 'selected' : '' }}>
                                                        {{ $item }}</option>
                                                @endforeach
                                            @endrole
                                        </select>
                                        @if ($errors->has('patient_id'))
                                            <span class="text-danger text-left">{{ $errors->first('patient_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Date</label>
                                        <span class="text-danger">*</span>
                                        <div class="input-group date" id="pres_date" data-target-input="nearest">
                                            <input name="date" type="text" class="form-control datetimepicker-input"
                                                data-target="#pres_date" placeholder="mm/dd/yyyy"
                                                value="{{ old('date') }}" />
                                            <div class="input-group-append" data-target="#pres_date"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @if ($errors->has('date'))
                                            <span class="text-danger text-left">{{ $errors->first('date') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Medicine</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="medicine_name" value="{{ old('medicine_name') }}"
                                            class="form-control" placeholder="Enter medicine name">
                                        @if ($errors->has('medicine_name'))
                                            <span
                                                class="text-danger text-left">{{ $errors->first('medicine_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Frequency</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="frequency" value="{{ old('frequency') }}"
                                            class="form-control" placeholder="Enter frequency">
                                        @if ($errors->has('frequency'))
                                            <span class="text-danger text-left">{{ $errors->first('frequency') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="">Duration</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="duration" value="{{ old('duration') }}"
                                            class="form-control" placeholder="Enter duration" id="num">
                                        @if ($errors->has('duration'))
                                            <span class="text-danger text-left">{{ $errors->first('duration') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-8">
                                        <label for="">Instruction</label>
                                        <textarea name="instruction" class="form-control" rows="3"></textarea>
                                        @if ($errors->has('instruction'))
                                            <span class="text-danger text-left">{{ $errors->first('instruction') }}</span>
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
                                $('#load_patient').empty();
                                $('#load_patient').append(
                                    '<option value=""> Select Patient</option>');
                                $.each(data.patients, function(key, value) {
                                    $('#load_patient').append($(
                                        "<option/>", {
                                            value: key,
                                            text: value
                                        }));

                                });
                            }
                        })
                    } else {
                        $('#load_doctor').empty();
                        $('#load_patient').empty();
                    }
                });
            });
        });
    </script>
@endsection
