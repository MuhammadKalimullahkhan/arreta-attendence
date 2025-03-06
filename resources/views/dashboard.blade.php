@extends('layout.base')

@section('mainContent')
    <!-- Metrics -->
    <section class="row">
        <div class="col-12">
            <h1 class="sectionTitle">Dashboard</h1>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <div class="text-muted">Total Employee</div>
                <div class="display-6 fw-bold my-2">522</div>
                <div class="small text-success">
                    <i class="fas fa-arrow-up me-1"></i>15% Compare to last month
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <div class="text-muted">Today Attendance</div>
                <div class="display-6 fw-bold my-2">500</div>
                <div class="small text-success">
                    <i class="fas fa-arrow-up me-1"></i>7% Compare to yesterday
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <div class="text-muted">Request Paid Leave</div>
                <div class="display-6 fw-bold my-2">15</div>
                <div class="small text-danger">
                    <i class="fas fa-arrow-down me-1"></i>22% Compare to yesterday
                </div>
            </div>
        </div>
    </section>

    <!-- Employee Status -->
    <section class="row mt-4">
        <!-- <div class="col-12">
                                        <h1 class="sectionTitle">Absent Users</h1>
                                      </div> -->
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
                                    <th>Job Level</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Aditya Wibowo</td>
                                    <td>Creative Director</td>
                                    <td>Senior Staff</td>
                                    <td>
                                        <span class="status-badge status-danger">Leave</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fahmi Pratama</td>
                                    <td>Project Manager</td>
                                    <td>Middle Staff</td>
                                    <td>
                                        <span class="status-badge status-danger">Leave</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fakhri Boden</td>
                                    <td>Fullstack Developer</td>
                                    <td>Junior Staff</td>
                                    <td>
                                        <span class="status-badge status-warning">Paid Leave</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
