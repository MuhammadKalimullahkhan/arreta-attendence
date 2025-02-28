@extends('layout.base')
@section('mainContent')

    <section class="row">
        <div class="col-12">
            <h1 class="sectionTitle">Attendance</h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Present</th>
                                <th>Employee</th>
                                <th>Designation</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendances as $attendance)

                                <tr>
                                    <td>
                                        <input
                                            type="checkbox"
                                            name="isPresent[]"
                                            id="isPresent"
                                            value="{{ $attendance->employee->id }}"
                                            @checked(true)
                                            class="form-check-input"
                                        />
                                    </td>
                                    <td>{{ $attendance->employee->name }}</td>
                                    <td>{{ $attendance->designation->description }}</td>
                                    <td>{{ $attendance->date }}</td>
                                    <td></td>
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
