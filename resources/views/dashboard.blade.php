@extends('layout.base')
@section('mainContent')
    <!-- Metrics -->
    <section class="row">
        <div class="col-12">
            <h1 class="sectionTitle">Dashboard</h1>
        </div>

        <!-- Total Employees -->
        <div class="col-md-4">
            <div class="card p-4">
                <div class="text-muted">Total Employees</div>
                <div class="display-6 fw-bold my-2">{{ $currentMonthEmployees }}</div>
                <div class="small {{ $employeeChange >= 0 ? 'text-success' : 'text-danger' }}">
                    <i class="fas fa-arrow-{{ $employeeChange >= 0 ? 'up' : 'down' }} me-1"></i>
                    {{ number_format(abs($employeeChange), 2) }}% Compare to last month
                </div>
            </div>
        </div>

        <!-- Today's Attendance -->
        <div class="col-md-4">
            <div class="card p-4">
                <div class="text-muted">Today's Attendance</div>
                <div class="display-6 fw-bold my-2">{{ $todayAttendance }}</div>
                <div class="small {{ $attendanceChange >= 0 ? 'text-success' : 'text-danger' }}">
                    <i class="fas fa-arrow-{{ $attendanceChange >= 0 ? 'up' : 'down' }} me-1"></i>
                    {{ number_format(abs($attendanceChange), 2) }}% Compare to yesterday
                </div>
            </div>
        </div>

        <!-- Paid Leave Requests -->
        <div class="col-md-4">
            <div class="card p-4">
                <div class="text-muted">Request Paid Leave</div>
                <div class="display-6 fw-bold my-2">{{ $todayPaidLeave }}</div>
                <div class="small {{ $paidLeaveChange >= 0 ? 'text-success' : 'text-danger' }}">
                    <i class="fas fa-arrow-{{ $paidLeaveChange >= 0 ? 'up' : 'down' }} me-1"></i>
                    {{ number_format(abs($paidLeaveChange), 2) }}% Compare to yesterday
                </div>
            </div>
        </div>
    </section>

    <!-- Employee Status -->
    <section class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Absent Users</h5>
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absentUsers as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role->description ?? 'N/A' }}</td>
                                        <td>{{ $user->designation->description ?? 'N/A' }}</td>
                                        <td>
                                            <span class="status-badge status-danger">Absent</span>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($absentUsers->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No absent users today.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
