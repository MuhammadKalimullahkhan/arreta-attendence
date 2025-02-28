@extends('layout.base')
@section('mainContent')

<section class="row">
  <div
    class="col-12 d-flex justify-content-between align-items-center"
  >
    <h1 class="sectionTitle">
      Payhead
      <small class="text-muted">List of all payhead</small>
    </h1>

    <button
      type="button"
      class="btn btn-primary btn-sm"
      data-bs-toggle="modal"
      data-bs-target="#payHeadModal"
    >
      Add Pay Head
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
                <td>Pay Head 1</td>
                <td>Kalimullah</td>
                <td>14-02-2025</td>
                <td>17-02-2025</td>
              </tr>
              <tr>
                <td>Pay Head 2</td>
                <td>Kalimullah</td>
                <td>14-02-2025</td>
                <td>17-02-2025</td>
              </tr>
              <tr>
                <td>Pay Head 3</td>
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
<script>
  $(document).ready(function () {
    $(".select2").select2({
      width: "100%",
      dropdownParent: $("#payHeadModal"),
    });
  });
  </script>
<!-- Modals -->
<!-- Add PayHead Modal -->
<div
  class="modal fade"
  id="payHeadModal"
  tabindex="-1"
  aria-labelledby="payHeadModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="payHeadModalLabel">Add Pay Head</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <form>
          <!-- Head Type Dropdown -->
          <div class="mb-3">
            <label for="headType" class="form-label"
              >Head Type <span class="text-danger">*</span></label
            >
            <select class="form-select select2" id="headType" required>
              <option value="Allowance">Allowance</option>
              <option value="Deduction">Deduction</option>
              <option value="Bonus">Bonus</option>
            </select>
          </div>

          <!-- Description Input -->
          <div class="mb-3">
            <label for="description" class="form-label"
              >Description <span class="text-danger">*</span></label
            >
            <input
              type="text"
              class="form-control"
              id="description"
              placeholder="Enter description"
              required
            />
          </div>

          <!-- Is Editable Checkbox -->
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="isEditable" />
            <label class="form-check-label" for="isEditable">Is Editable</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>
<!-- End Add Designation Modal -->
@endsection
