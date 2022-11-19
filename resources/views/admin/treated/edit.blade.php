@extends('layouts.admin')

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Treated</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Treated</li>
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
                <div class="col-md-8">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            @include('layouts.partials.messages')
                            <form action="{{ route('treated.update', $treated->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4">
                                    <div class="form-group col-sm-12">
                                        <label for="">Teeth</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="teeth" value="{{ $treated->teeth }}"
                                            class="form-control" placeholder="teeth">
                                        @if ($errors->has('teeth'))
                                            <span class="text-danger text-left">{{ $errors->first('teeth') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="">Problem</label>
                                        <span class="text-danger">*</span>
                                        <textarea name="problem" id="" class="form-control" rows="2">{{ $treated->problem }}</textarea>
                                        @if ($errors->has('problem'))
                                            <span class="text-danger text-left">{{ $errors->first('problem') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="">Upload File</label>
                                        <input type="file" name="file" class="form-control" id="chooseFile">
                                        <input type="hidden" name="old_file" value="{{ $treated->name }}">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="">Remarks</label>
                                        <span class="text-danger">*</span>
                                        <textarea name="remarks" id="" class="form-control" rows="3">{{ $treated->remarks }}</textarea>
                                        @if ($errors->has('contact'))
                                            <span class="text-danger text-left">{{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Fee</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" name="fee" value="{{ $treated->fee }}"
                                            class="form-control" onkeypress="return isNumber(event)"
                                            placeholder="Enter fee">
                                        @if ($errors->has('fee'))
                                            <span class="text-danger text-left">{{ $errors->first('fee') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Status</label>
                                        <span class="text-danger">*</span>
                                        <select name="status" class="custom-select">
                                            <option value=""> Select a status</option>
                                            <option value="active" {{ $treated->status == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="closed" {{ $treated->status == 'closed' ? 'selected' : '' }}>
                                                Closed
                                            </option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            Details
                            <a href="{{ route('treated.index') }}" class="btn btn-sm btn-danger float-right"> Back</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <b>Name: </b>{{ $treated->appointment->patients->full_name }} <br>
                                        <b>Email: </b>{{ $treated->appointment->patients->email }}<br>
                                        <b>Contact: </b>{{ $treated->appointment->patients->contact }}<br>
                                        <hr>
                                        <b>Clinic Name: </b>{{ $treated->appointment->clinic->name }}<br>
                                        <b>Doctor Name: </b>{{ $treated->appointment->doctors->full_name }}<br>
                                        <b>Service:</b> {{ implode(', ', $treated->appointment->service) }}<br>
                                        @if ($treated->status == 'active')
                                            <span class="badge badge-primary">{{ $treated->status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $treated->status }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($transact))
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Appointment Fee</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>Reference No.</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transact as $data)
                                                <tr>
                                                    <td><a
                                                            href="pages/examples/invoice.html">{{ $data->reference_no }}</a>
                                                    </td>
                                                    <td>{{ $data->amount }}</td>
                                                    <td><span class="badge badge-success">Paid</span></td>
                                                    <td>{{ $data->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- /.row (main row) -->
        @endsection
