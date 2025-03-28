@extends('layout.base')
@section('mainContent')

<section class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="sectionTitle">
            Information
            <small class="text-muted">Employees information</small>
        </h1>


    </div>
    <div class="col-12">
        <div class="card parent">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>CNIC</th>
                                        <th>Desigantion</th>
                                        <th>Salary</th>
                                        <th>Anual leave</th>
                                        <th>Other leave</th>
                                        <th>Unpaid leave</th>
                                        <th>Basic salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->cnic }}</td>
                                            <td>{{ optional($employee->designation)->description }}</td>
                                            <td>
                                                {{ $employee->payrollSetup->sum('amount') }}
                                            </td>
                                            <td>0</td> <!-- Placeholder for Annual leave -->
                                            <td>0</td> <!-- Placeholder for Other leave -->
                                            <td>0</td> <!-- Placeholder for Unpaid leave -->
                                            <td>{{ $employee->payrollSetup->where('payHeadType.description', 'Basic')->sum('amount') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
