@extends('layout.base')
@section('mainContent')
    <section class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="sectionTitle">
                Attendance
                <small class="text-muted">List of all Employees Attendance</small>
            </h1>

        </div>
        <div class="col-12">
            <div class="card parent">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-12">
                            <label>Filters</label>
                        </div>
                        <div class="col-5">
                            <select id="departmentFilter" class="form-select select2">
                                <option value="" selected>All Departments</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <select id="designationFilter" class="form-select select2">
                                <option value="" selected> All Designations</option>
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary w-100" id="btn_save" title="Save Attendance">
                                <i class="fa-solid fa-floppy-disk"></i>
                                Save
                            </button>
                        </div>
                        <div id="error_employees" class="invalid"></div>
                        <div class="col-12 mt-3">
                            <form action="{{ route('attendances.store') }}" method="post" id="myForm">
                                @csrf
                                <div class="table-responsive">
                                    @include('partials.attendance-table', [
                                        'usersWithoutAttendance' => $usersWithoutAttendance,
                                    ])
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').on('select2:select select2:unselect', function(e) {
                fetchUsers();
            });

            // Function to fetch users based on filters
            function fetchUsers() {
                let departmentId = $("#departmentFilter").val();
                let designationId = $("#designationFilter").val();

                $.ajax({
                    url: "{{ route('attendances.filterUsers') }}",
                    type: "GET",
                    data: {
                        department_id: departmentId,
                        designation_id: designationId,
                    },
                    success: function(response) {
                        updateUsersTable(response);
                    },
                    error: function() {
                        dangerAlert("Error", "Failed to load users.");
                    },
                });
            }

            // Function to update the users table
            function updateUsersTable(response) {
                if (response?.success) {
                    $("#usersTable").html(response.html);
                }
            }

            // Function to handle form submission
            function submitForm() {
                $(".invalid").text(""); // Reset error messages

                let formData = $("#myForm").serialize();

                $.ajax({
                    url: "{{ route('attendances.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            successAlert("Success", response.message);
                            $(".select2").val(null).trigger('change'); // Reset filters
                            fetchUsers(); // Reload users after successful submission

                        }
                    },
                    error: function(xhr) {
                        handleValidationErrors(xhr);
                    },
                });
            }

            // Function to handle validation errors
            function handleValidationErrors(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        $(`#error_${field}`).text(errors[field][0]);
                    }
                } else {
                    console.log(xhr.responseText);
                    dangerAlert("Failed", "Failed to update attendance.");
                }
            }

            // Event bindings
            $("#myForm").on("submit", function(e) {
                e.preventDefault();
                submitForm();
            });
            $("#btn_save").on("click", (e) => confirmAlert(e, submitForm));
        });
    </script>
@endsection
