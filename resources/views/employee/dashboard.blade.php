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
                <div class="text-muted">Grass Salary</div>
                <div class="display-6 fw-bold my-2">50000</div>
                <div class="small text-success">
                    <i class="fas fa-arrow-up me-1"></i>
                    10% Compare to last month
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Employee Status -->
    {{-- <section class="row mt-4">
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
    </section> --}}
@endsection
