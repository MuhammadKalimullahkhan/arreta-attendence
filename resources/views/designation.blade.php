@extends('layout.base')
@section('mainContent')
    <section class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="sectionTitle">
                Designation
                <small class="text-muted">List of all designation</small>
            </h1>

            <button type="button" class="btn btn-primary btn-sm" onclick="openModal(null)">
                Add Designation
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
                                @foreach ($activeDesignation as $desig)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $desig->description }}</td>
                                        <td>{{ $desig->created_at }}</td>
                                        <td>{{ $desig->updated_at }}</td>
                                        <td>
                                            <x-action-dropdown itemId="{{ $desig->id }}"
                                                route="{{ route('designations.destroy', $desig->id) }}" />
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
    <!-- Add Designation Modal -->
    <div class="modal fade parent" id="upsertModal" tabindex="-1" aria-labelledby="upsertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="upsertModalLabel">
                        Add Designation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('designations.create') }}">
                        @csrf
                        <input type="hidden" name="id" id="designationId">
                        <!-- Description Input -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Designation Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="description" name="description" placeholder="HR"
                                class="form-control" />
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
    <!-- End Add Designation Modal -->
@endsection


@section('scripts')
    <script src="/js/utils.js"></script>
    <script>
        function openModal(id = null) {
            if (id) {
                // Edit mode
                $('.modal .modal-title').text('Edit Designation');
                $('.modal form button[type="submit"]').text('Update');

                $.get('{{ route('designations.index') }}' + '/' + id, function(response) {
                    if (response.success) {
                        const payHead = formatObject(response.data[0]);
                        populateValues(payHead) // set values to form
                    }
                });
            } else {
                // Create mode
                $('.modal .modal-title').text('Add Designation');
                $('.modal form button[type="submit"]').text('Create');

                $('#designationId').val(null);
                $('#upsertModal form')[0].reset();
            }
            $('#upsertModal').modal('show');
        }

        $('#upsertModal form').submit(function(event) {
            event.preventDefault();

            let id = $('#designationId').val();
            let url = id ? '{{ route('designations.index') }}/' + id : '{{ route('designations.store') }}';
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
                    dangerAlert("Failed", "Failed to update/create.");
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endsection
