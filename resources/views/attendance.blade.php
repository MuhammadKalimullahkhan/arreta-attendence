@extends('layout.base')
@section('mainContent')

    <section class="row">
        <div class="col-12">
            <h1 class="sectionTitle">Attendance</h1>
        </div>
        <div class="col-12">
            <div class="card parent">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-12">
                            <label>Filters</label>
                        </div>
                        <div class="col-5">
                            <select class="form-select select2">
                                <option disabled selected> Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <select class="form-select select2">
                                <option disabled selected> Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary w-100">Save</button>
                        </div>
                        <div class="col-12 mt-3">
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
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        {{-- js here --}}
    </script>
@endsection
