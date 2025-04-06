@extends('layout.base')

@section('mainContent')
    <section class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="sectionTitle">
                Role
                <small class="text-muted">List of all role</small>
            </h1>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upsertModal"
                onclick="openModal(null)" title="Add New Role">
                <i class="fa-solid fa-plus"></i>
                Add Role
            </button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Added At</th>
                                    <th>Updated At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activeRoles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ $role->created_at }}</td>
                                        <td>{{ $role->updated_at }}</td>
                                        <td>
                                            <x-action-dropdown itemId="{{ $role->id }}"
                                                route="{{ route('roles.destroy', $role->id) }}" />
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
    <!-- Add Role Modal -->
    <div class="modal fade parent" id="upsertModal" tabindex="-1" aria-labelledby="upsertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="upsertModalLabel">Add Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('roles.create') }}">
                        @csrf
                        <input type="hidden" name="id" id="roleId">
                        <!-- Description Input -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" id="description" name="description" placeholder="Admin"
                                class="form-control" />
                            <div id="error_description" class="invalid"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Role</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Role Modal -->
@endsection



@section('scripts')
    <script src="/js/utils.js"></script>
    <script>
        function openModal(id = null) {
            $("#error_description").text(null)

            if (id) {
                // Edit mode
                $('.modal .modal-title').text('Edit Role');
                $('.modal form button[type="submit"]').text('Update');

                $.get('{{ route('roles.index') }}' + '/' + id, function(response) {
                    if (response.success) {
                        const payHead = formatObject(response.data[0]);
                        populateValues(payHead) // set values to form
                    }
                });
            } else {
                // Create mode
                $('.modal .modal-title').text('Add Role');
                $('.modal form button[type="submit"]').text('Create');

                $('#roleId').val(null);
                $('#upsertModal form')[0].reset();
            }
            $('#upsertModal').modal('show');
        }

        $('#upsertModal form').submit(function(event) {
            event.preventDefault();

            let id = $('#roleId').val();
            let url = id ? '{{ route('roles.index') }}/' + id : '{{ route('roles.store') }}';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#upsertModal').modal('hide');
                        successAlert("Updated",
                            "Role updated successfully."); // Reload page to update data
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
