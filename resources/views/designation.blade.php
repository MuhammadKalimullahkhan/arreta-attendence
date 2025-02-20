@extends('layout.base')
@section('mainContent')
<section class="row">
  <div
    class="col-12 d-flex justify-content-between align-items-center"
  >
    <h1 class="sectionTitle">
      Designation
      <small class="text-muted">List of all designation</small>
    </h1>

    <button
      type="button"
      class="btn btn-primary btn-sm"
      data-bs-toggle="modal"
      data-bs-target="#addDesignationModal"
    >
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
                <th>Name</th>
                <th>Added By</th>
                <th>Added At</th>
                <th>Updated At</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Designation 1</td>
                <td>Kalimullah</td>
                <td>14-02-2025</td>
                <td>17-02-2025</td>
              </tr>
              <tr>
                <td>Designation 2</td>
                <td>Kalimullah</td>
                <td>14-02-2025</td>
                <td>17-02-2025</td>
              </tr>
              <tr>
                <td>Designation 3</td>
                <td>Kalimullah</td>
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
<!-- Add Designation Modal -->
<div
  class="modal fade"
  id="addDesignationModal"
  tabindex="-1"
  aria-labelledby="addDesignationModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDesignationModalLabel">
          Add Designation
        </h5>
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
              >Designation Name <span class="text-danger">*</span></label
            >
            <input
              type="text"
              class="form-control"
              id="description"
              placeholder="Manager"
              required
            />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Add Designation</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>
<!-- End Add Designation Modal -->
@endsection