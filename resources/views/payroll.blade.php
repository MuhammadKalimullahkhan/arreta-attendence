@extends('layout.base')

@section('mainContent')
    <section class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="sectionTitle">
                Pay role
                <small class="text-muted">List of all Pay role</small>
            </h1>

            {{-- <button class="btn btn-primary btn-sm" onclick="openModal(null)">
                Add Department
            </button> --}}
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="5" style="border: 1px solid var(--bs-gray-700);"></th>
                                    <th colspan="4"
                                        style="border: 1px solid var(--bs-gray-700); border-left: none; background-color: #aeeeee;">
                                        Fixed Earnings</th>
                                    <th colspan="3"
                                        style="border: 1px solid var(--bs-gray-700); border-left: none; background-color: #fedab8;">
                                        Variable Earning & Benefits</th>
                                </tr>
                                <tr>
                                    <th>Is Hold</th>
                                    <th>Employee</th>
                                    <th>Designation</th>
                                    <th>Joining Date</th>
                                    <th>Status</th>
                                    <th>01-Basic Salary</th>
                                    <th>02-Medical</th>
                                    <th>03-House rent</th>
                                    <th>Total Gross salary</th>
                                    <th>05-monthly commision</th>
                                    <th>Total variable earning</th>
                                    <th>Total gross</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payrolls as $payroll)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="isHold[]" @checked($payroll['is_hold']) class="form-check-input" />
                                        </td>
                                        <td>{{ $payroll['employee'] }}</td>
                                        <td>{{ $payroll['designation'] }}</td>
                                        <td>{{ $payroll['joining_date'] }}</td>
                                        <td>{{ $payroll['status'] }}</td>
                                        <td>{{ number_format($payroll['basic_salary'], 2) }}</td>
                                        <td>{{ number_format($payroll['medical'], 2) }}</td>
                                        <td>{{ number_format($payroll['house_rent'], 2) }}</td>
                                        <td>{{ number_format($payroll['total_gross_salary'], 2) }}</td>
                                        <td>{{ number_format($payroll['monthly_commission'], 2) }}</td>
                                        <td>{{ number_format($payroll['total_variable_earning'], 2) }}</td>
                                        <td>{{ number_format($payroll['total_gross'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modals -->
    <!-- Department Modal -->
    <div class="modal fade parent" id="upsertModal" tabindex="-1" aria-labelledby="departmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentModalLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('departments.create') }}">
                        @csrf
                        <input type="hidden" name="id" id="currentId">
                        <!-- This field is updated dynamically -->

                        <div class="mb-3">
                            <label for="description" class="form-label">Department Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="description" name="description" placeholder="Finance"
                                class="form-control">
                            <div id="error_description" class="invalid"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Department</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- End Add Department Modal -->
@endsection

@section('scripts')
    <script src="/js/utils.js"></script>
    <script>
        function openModal(id = null) {
            $("#error_description").text(null)
            if (id) {
                // Edit mode
                $('.modal .modal-title').text('Edit Designation');
                $('.modal form button[type="submit"]').text('Update');

                $.get('{{ route('departments.index') }}' + '/' + id, function(response) {
                    if (response.success) {
                        const payHead = formatObject(response.data[0]);
                        populateValues(payHead) // set values to form
                    }
                });
            } else {
                // Create mode
                $('.modal .modal-title').text('Add Designation');
                $('.modal form button[type="submit"]').text('Create');

                $('#currentId').val(null);
                $('#upsertModal form')[0].reset();
            }
            $('#upsertModal').modal('show');
        }

        $('#upsertModal form').submit(function(event) {
            event.preventDefault();

            let id = $('#currentId').val();
            let url = id ? '{{ route('departments.index') }}/' + id : '{{ route('departments.store') }}';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#upsertModal').modal('hide');
                        successAlert("Success", response.message); // Reload page to update data
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            $(`#error_${field}`).text(errors[field][0]);
                        }
                    } else {
                        console.log(xhr.responseText);
                        dangerAlert("Failed", "Failed to update the role.")
                    }
                }
            });
        });
    </script>
@endsection
