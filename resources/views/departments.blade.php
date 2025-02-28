@extends('layout.base')

@section('mainContent')
    <section class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="sectionTitle">
                Department
                <small class="text-muted">List of all departments</small>
            </h1>

            <button
                class="btn btn-primary btn-sm"
                onclick="openModal(null)">
                Add Department
            </button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Added At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($departments as $department)
                                <tr id="department-{{ $department->id }}">
                                    <td>{{ $department->description }}</td>
                                    <td>{{ \Carbon\Carbon::parseDate($department->created_at) }}</td>
                                    <td>{{ \Carbon\Carbon::parseDate($department->updated_at) }}</td>
                                    <td>
                                        <x-action-dropdown itemId="{{$department->id}}"
                                                           route="{{ route('departments.destroy', $department->id) }}"/>
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
    <!-- Modals -->
    <!-- Department Modal -->
    <div class="modal fade" id="upsertModal" tabindex="-1" aria-labelledby="departmentModalLabel"
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
                            <input
                                type="text"
                                id="description"
                                name="description"
                                placeholder="Finance"
                                class="form-control" required>
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
            if (id) {
                // Edit mode
                $('.modal .modal-title').text('Edit Designation');
                $('.modal form button[type="submit"]').text('Update');

                $.get('{{ route("departments.index") }}' + '/' + id, function (response) {
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

        $('#upsertModal form').submit(function (event) {
            event.preventDefault();

            let id = $('#currentId').val();
            let url = id ? '{{ route("departments.index") }}/' + id : '{{ route("departments.store") }}';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function (response) {
                    if (response.success) {
                        $('#upsertModal').modal('hide');
                        successAlert("Success", response.message); // Reload page to update data
                    }
                },
                error: function (xhr) {
                    dangerAlert("Failed", "Failed to update/create.");
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endsection
