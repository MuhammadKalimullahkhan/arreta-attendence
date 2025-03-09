@extends('layout.base')
@section('mainContent')
    {{-- Cards Section --}}
    <section class="row">
        <div class="col-12">
            <h1 class="sectionTitle">
                Attendance Dashboard - {{ \Carbon\Carbon::now()->format('F Y') }}
            </h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="text-muted">Total Working Days</div>
                    <div class="display-6 fw-bold my-2">{{ $totalWorkingDays }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="text-muted">Present Days</div>
                    <div class="display-6 fw-bold my-2">{{ $presentDays }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="text-muted">Absent Days</div>
                    <div class="display-6 fw-bold my-2">{{ $absentDays }}</div>
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
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendances as $attendance)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                                        <td>
                                            @if ($attendance->is_present)
                                                <span class="status-badge status-success">Present</span>
                                            @else
                                                <span class="status-badge status-danger">Absent</span>
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
