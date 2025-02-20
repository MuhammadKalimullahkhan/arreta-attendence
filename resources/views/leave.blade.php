@extends('layout.base')
@section('mainContent')
          <section class="row">
            <div class="col-12 d-flex align-items-center">
              <h1 class="sectionTitle">
                Leave
                <small class="text-muted"> All leave applications </small>
              </h1>
              <button
                type="button"
                class="ms-auto btn btn-sm btn-outline-primary"
                data-bs-toggle="modal"
                data-bs-target="#applicationModal"
              >
                Application
              </button>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="dataTable" class="table table-hover">
                      <thead>
                        <tr>
                          <th>Approved/Rejected By</th>
                          <th>Days</th>
                          <th>Leave Type</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Kalimullah</td>
                          <td>3</td>
                          <td>Leave</td>
                          <td>
                            <span class="status-badge status-success"
                              >Approved</span
                            >
                          </td>
                        </tr>
                        <tr>
                          <td>Nafisa Qamar</td>
                          <td>1</td>
                          <td>Paid Leave</td>
                          <td>
                            <span class="status-badge status-success"
                              >Approved</span
                            >
                          </td>
                        </tr>
                        <tr>
                          <td>Gul Raziq</td>
                          <td>2</td>
                          <td>Paid Leave</td>
                          <td>
                            <span class="status-badge status-danger"
                              >Rejected</span
                            >
                          </td>
                        </tr>
                        <tr>
                          <td>Gul Raziq</td>
                          <td>5</td>
                          <td>Paid Leave</td>
                          <td>
                            <span class="status-badge status-warning"
                              >Pending</span
                            >
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>
     

<!-- Application Modal -->
<div
  class="modal fade"
  id="applicationModal"
  tabindex="-1"
  aria-labelledby="applicationModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="applicationModalLabel">
          Send Absent Application
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
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <div class="input-group">
              <input
                type="text"
                class="form-control"
                id="title"
                placeholder="Medical Leave"
              />
            </div>
          </div>
          <div class="mb-3">
            <label for="numberOfDays" class="form-label">Number of Days</label>
            <input
              type="number"
              class="form-control"
              id="numberOfDays"
              placeholder="No. of days"
            />
          </div>
          <div class="mb-3">
            <label for="absentDate" class="form-label">Date</label>
            <div class="input-group">
              <input type="date" class="form-control" id="absentDate" />
            </div>
          </div>
          <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <textarea
              class="form-control"
              id="reason"
              rows="3"
              placeholder="Reason for being absent..."
            ></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <button
            type="button"
            class="btn btn-outline-danger"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            Cancel
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection