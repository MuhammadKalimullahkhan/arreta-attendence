@extends('layout.base')

@section('mainContent')
  
  <section class="row">
    <div
      class="col-12 d-flex justify-content-between align-items-center"
    >
      <h1 class="sectionTitle">
        Department
        <small class="text-muted">List of all departments</small>
      </h1>

      <button
        type="button"
        class="btn btn-primary btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#addDepartmentModal"
      >
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
                  <th>Added By</th>
                  <th>Added At</th>
                  <th>Updated At</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Department 1</td>
                  <td>Niaz Ali</td>
                  <td>14-02-2025</td>
                  <td>17-02-2025</td>
                </tr>
                <tr>
                  <td>Department 2</td>
                  <td>Niaz Ali</td>
                  <td>14-02-2025</td>
                  <td>17-02-2025</td>
                </tr>
                <tr>
                  <td>Department 3</td>
                  <td>Niaz Ali</td>
                  <td>14-02-2025</td>
                  <td>17-02-2025</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Modals -->
<!-- Add Department Modal -->
<div
  class="modal fade"
  id="addDepartmentModal"
  tabindex="-1"
  aria-labelledby="addDepartmentModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDepartmentModalLabel">Add Department</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <form>
          <!-- Description Input -->
          <div class="mb-3">
            <label for="description" class="form-label"
              >Department Name <span class="text-danger">*</span></label
            >
            <input
              type="text"
              class="form-control"
              id="description"
              placeholder="Medical"
              required
            />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Add Department</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>
<!-- End Add Department Modal -->
@endsection