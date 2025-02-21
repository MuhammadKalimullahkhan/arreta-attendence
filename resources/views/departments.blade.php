@extends('layout.base')

@section('mainContent')
    <section class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="sectionTitle">
                Department
                <small class="text-muted">List of all departments</small>
            </h1>

            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
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
                                        <td>{{ \Carbon\Carbon::parse($department->EntryDate)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($department->updated_at)->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown">Actions</button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button class="dropdown-item text-success"
                                                            onclick="editDepartment({{ $department->id }}, '{{ $department->description }}')">
                                                            <ion-icon name="create-outline"></ion-icon> Edit
                                                        </button>

                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item text-danger"
                                                            hx-delete="{{ route('departments.delete', $department->id) }}"
                                                            hx-target="closest tr"
                                                            hx-on::confirm="return confirmAlert(event);"
                                                            hx-on::after-request="successAlert('Deleted', 'Department has been deleted.')">Delete</button>
                                                    </li>
                                                </ul>
                                            </div>
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
    <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="departmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="departmentModalLabel">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addDepartmentForm" method="POST" action="{{ route('departments.create') }}"
                        onsubmit="confirmAlert(event,()=>handleForm(event))">
                        @csrf
                        <input type="hidden" name="id" id="departmentId">
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <!-- This field is updated dynamically -->

                        <div class="mb-3">
                            <label for="description" class="form-label">Department Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="description" id="description" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Department</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- End Add Department Modal -->

    <script>
        function editDepartment(id, description) {
            // Update Modal Title
            document.getElementById("departmentModalLabel").textContent = "Edit Department";

            // Set Form Action for Editing
            let form = document.getElementById("addDepartmentForm");
            form.setAttribute("action", `/departments/${id}`); // Update route

            // Set the correct method
            document.getElementById("formMethod").value = "PUT";

            // Fill Form with Existing Data
            document.getElementById("departmentId").value = id;
            document.getElementById("description").value = description;

            // Show Modal
            let modal = new bootstrap.Modal(document.getElementById("addDepartmentModal"));
            modal.show();
        }

        // Reset Modal on Close
        document.getElementById('addDepartmentModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById("departmentModalLabel").textContent = "Add Department";

            let form = document.getElementById("addDepartmentForm");
            form.setAttribute("action", "{{ route('departments.create') }}"); // Reset to Create
            document.getElementById("formMethod").value = "POST"; // Reset method to POST
            document.getElementById("departmentId").value = "";
            document.getElementById("description").value = "";
        });

        const handleForm = async (event) => {
            try {
                event.preventDefault();

                const form = event.target;
                const formData = new FormData(form);
                const method = form.getAttribute("method").toLowerCase() === 'post' ? "POST" : "PUT";
                const url = form.getAttribute("action")

                console.log("http method", method);

                let response = await fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value
                    }
                });

                let data = await response.json();

                if (data.success) {
                    let modal = bootstrap.Modal.getInstance(document.getElementById("addDepartmentModal"));
                    modal.hide();
                    form.reset();

                    if (method === 'post') {
                        document.querySelector("#dataTable tbody").innerHTML += data.html;
                    } else {
                        let row = document.getElementById(`department-${data.id}`);
                        row.innerHTML = data.html;
                    }

                    successAlert("Updated", "Department updated successfully")
                } else {
                    alert(data.message);
                }
            } catch (error) {
                dangerAlert("Error", "error");
            }
        }
    </script>
@endsection


{{-- <form id="addDepartmentForm" method="POST"
        hx-on::confirm="return confirmAlert(event)" hx-post="{{ route('departments.create') }}"
        hx-target="#dataTable tbody" hx-swap="beforeend"
        hx-on::after-request="this.reset(); bootstrap.Modal.getInstance(document.getElementById('addDepartmentModal')).hide();">
        @csrf
        <div class="mb-3">
            <label for="description" class="form-label">Department Name <span
                    class="text-danger">*</span></label>
            <input type="text" name="description" id="description" placeholder="Medical"
                class="form-control" required />
        </div>
        <button type="submit" class="btn btn-primary">Add Department</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
    </form> --}}
