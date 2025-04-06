@extends('layout.base')
@section('mainContent')
    <!-- Metrics -->
    <section class="row tiles">
        <div class="col-12">
            <h1 class="sectionTitle">Dashboard</h1>
        </div>

        <!-- Total Employees -->
        <div class="col-md-4">
            <div class="card tile tile-primary">
                <div class="head">{{ $currentMonthEmployees }}</div>
                <i class="card-icon fas fa-users"></i>
                <div class="title">Total Employees</div>
                <div class="info-text {{ $employeeChange >= 0 ? 'text-white' : 'text-danger' }}">
                    <i class="fas fa-arrow-{{ $employeeChange >= 0 ? 'up' : 'down' }} me-1"></i>
                    {{ number_format(abs($employeeChange), 2) }}% Compare to last month
                </div>
            </div>
        </div>

        <!-- Today's Attendance -->
        <div class="col-md-4">
            <div class="card tile tile-success">
                <div class="head">{{ $todayAttendance }}</div>
                <i class="card-icon fas fa-calendar-check"></i>
                <div class="title">Today's Attendance</div>
                <div class="info-text {{ $attendanceChange >= 0 ? 'text-white' : 'text-danger' }}">
                    <i class="fas fa-arrow-{{ $attendanceChange >= 0 ? 'up' : 'down' }} me-1"></i>
                    {{ number_format(abs($attendanceChange), 2) }}% Compare to yesterday
                </div>
            </div>
        </div>

        <!-- Paid Leave Requests -->
        <div class="col-md-4">
            <div class="card tile tile-warning">
                <div class="head">{{ $todayPaidLeave }}</div>
                <i class="card-icon fas fa-money-bill-wave"></i>
                <div class="title">Request Paid Leave</div>
                <div class="info-text {{ $paidLeaveChange >= 0 ? 'text-white' : 'text-danger' }}">
                    <i class="fas fa-arrow-{{ $paidLeaveChange >= 0 ? 'up' : 'down' }} me-1"></i>
                    {{ number_format(abs($paidLeaveChange), 2) }}% Compare to yesterday
                </div>
            </div>
        </div>
    </section>

    {{-- Charts --}}
    <section class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Monthly Attendance</h5>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Monthly Absenties</h5>
                    <canvas id="barChart"></canvas>
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
                                            @if ($user->leaveQuota[0]->is_without_pay == false)
                                                <span class="status-badge status-warning">Paid Leave</span>
                                            @else
                                                <span class="status-badge status-danger">Unpaid Leave</span>
                                            @endif
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

@section('scripts')
    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Attendance Line Chart
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_map(fn($d) => 'Day ' . $d, $daysOfMonth)) !!},
                datasets: [{
                    label: 'Employees Present',
                    data: {!! json_encode($dailyAttendanceCounts) !!},
                    borderColor: 'white',
                    backgroundColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Days of Month'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Employees'
                        }
                    }
                }
            }
        });

        // Leave Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_map(fn($d) => 'Day ' . $d, $daysOfMonth)) !!},
                datasets: [{
                    label: 'Employees Absent',
                    data: {!! json_encode($dailyAbsentCounts) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Days of Month'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Employees'
                        }
                    }
                }
            }
        });
    </script>
@endsection
