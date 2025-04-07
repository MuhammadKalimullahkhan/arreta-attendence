@extends('layout.base')
@section('mainContent')
    {{-- Cards Section --}}
    <section class="row">
        <div class="col-12">
            <h1 class="sectionTitle">
                Attendance Dashboard - {{ \Carbon\Carbon::now()->format('F Y') }}
            </h1>
        </div>
        <div class="row tiles">
            <div class="col-md-4">
                <div class="card tile tile-primary">
                    <div class="head">{{ $totalWorkingDays }}</div>
                    <i class="card-icon fas fa-calendar-days"></i>
                    <div class="title">Days</div>
                    <div class="info-text">Total Working Days</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card tile tile-success">
                    <div class="head">{{ $presentDays }}</div>
                    <i class="card-icon fas fa-user-check"></i>
                    <div class="title">Days</div>
                    <div class="info-text">Present Days</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card tile tile-danger">
                    <div class="head">{{ $absentDays }}</div>
                    <i class="card-icon fas fa-user-xmark"></i>
                    <div class="title">Days</div>
                    <div class="info-text">Absent Days</div>
                </div>
            </div>

        </div>
    </section>

    {{-- Attendance section --}}
    <section class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Attendance Records</h5>
                    <div class="table-responsive">
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $index => $attendance)
                                    <tr>
                                        @if ($index === 0)
                                            <td rowspan="{{ $attendances->count() }}">
                                                {{ $attendance->employee->name }}
                                            </td>
                                        @endif
                                        <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                                        <td>
                                            @if ($attendance->is_present)
                                                <span class="status-badge status-success">Present</span>
                                            @else
                                                <span class="status-badge status-danger">
                                                    Absent |
                                                    {{ $attendance->employee->leaveQuota->first()->paid_leave ? 'Paid Leave' : 'Unpaid Leave' }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
