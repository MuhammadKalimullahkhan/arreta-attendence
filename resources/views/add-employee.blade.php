<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wazar Solutions & Services</title>
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/styles.css" />

    <script defer src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link
      href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
      .select2-container .select2-selection--single {
        height: 38px;
        padding: 6px 12px;
        border: 1px solid #ced4da;
        border-radius: 5px;
      }
      .select2-container--default
        .select2-selection--single
        .select2-selection__rendered {
        line-height: 24px;
      }
      .select2-container--default
        .select2-selection--single
        .select2-selection__arrow {
        height: 36px;
      }
    </style>
  </head>
  <body>
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#addEmployeeModal"
    >
      Add Employee
    </button>

    <!-- Modal -->
    <div
      class="modal fade"
      id="addEmployeeModal"
      tabindex="-1"
      aria-labelledby="addEmployeeModalLabel"
      aria-hidden="true"
    >
      <div
        class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addEmployeeModalLabel">
              Add Employee
            </h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <!-- Tabs navigation -->
            <ul class="nav nav-underline" id="modalTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link active"
                  id="initialInfo-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#initialInfo"
                  type="button"
                  role="tab"
                  aria-controls="initialInfo"
                  aria-selected="true"
                >
                  Initial Info
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link"
                  id="payrollSetup-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#payrollSetup"
                  type="button"
                  role="tab"
                  aria-controls="payrollSetup"
                  aria-selected="false"
                >
                  Payroll Setup
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button
                  class="nav-link"
                  id="leaveQuota-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#leaveQuota"
                  type="button"
                  role="tab"
                  aria-controls="leaveQuota"
                  aria-selected="false"
                >
                  Leave Quota
                </button>
              </li>
            </ul>

            <!-- Tabs content -->
            <div class="tab-content mt-3" id="modalTabsContent">
              <!-- Initial Info -->
              <div
                class="tab-pane fade show active"
                id="initialInfo"
                role="tabpanel"
                aria-labelledby="initialInfo-tab"
              >
                <div class="card">
                  <div class="card-body">
                    <form action="">
                      <div class="row g-3">
                        <div class="col-12 col-lg-6">
                          <label for="tb_name" class="form-label"
                            >Name&nbsp;<span class="text-danger">*</span></label
                          >
                          <input
                            id="tb_name"
                            type="text"
                            class="form-control"
                            placeholder="Niaz Ali"
                          />
                        </div>
                        <div class="col-12 col-lg-6">
                          <label for="tb_cnic" class="form-label"
                            >CNIC&nbsp;<span class="text-danger">*</span></label
                          >
                          <input
                            id="tb_cnic"
                            type="text"
                            class="form-control"
                            placeholder="15605-1234567-8"
                          />
                        </div>
                        <div class="col-12 col-lg-6">
                          <label for="tb_contact" class="form-label"
                            >Contact&nbsp;<span class="text-danger"
                              >*</span
                            ></label
                          >
                          <input
                            id="tb_contact"
                            type="text"
                            class="form-control"
                            placeholder="0345-1234567"
                          />
                        </div>
                        <div class="col-12 col-lg-6">
                          <label for="dd_department" class="form-label"
                            >Department&nbsp;<span class="text-danger"
                              >*</span
                            ></label
                          >
                          <select
                            id="dd_department"
                            class="form-select select2"
                          >
                            <option disabled selected>
                              -- Select Department --
                            </option>
                            <option>Department 1</option>
                            <option>Department 2</option>
                            <option>Department 3</option>
                            <option>Department 4</option>
                            <option>Department 5</option>
                          </select>
                        </div>

                        <div class="col-12 col-lg-6">
                          <label for="dd_role" class="form-label"
                            >Role&nbsp;<span class="text-danger">*</span></label
                          >
                          <select id="dd_role" class="form-select select2">
                            <option disabled selected>-- Select Role --</option>
                            <option>Role 1</option>
                            <option>Role 2</option>
                            <option>Role 3</option>
                            <option>Role 4</option>
                            <option>Role 5</option>
                          </select>
                        </div>

                        <div class="col-12 col-lg-6">
                          <label for="dd_designation" class="form-label"
                            >Designation&nbsp;<span class="text-danger"
                              >*</span
                            ></label
                          >
                          <select
                            id="dd_designation"
                            class="form-select select2"
                          >
                            <option disabled selected>
                              -- Select Designation --
                            </option>
                            <option>Designation 1</option>
                            <option>Designation 2</option>
                            <option>Designation 3</option>
                            <option>Designation 4</option>
                            <option>Designation 5</option>
                          </select>
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary">
                            Save
                          </button>
                          <button
                            type="button"
                            class="btn btn-danger"
                            data-bs-dismiss="modal"
                          >
                            Close
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Payroll Setup -->
              <div
                class="tab-pane fade"
                id="payrollSetup"
                role="tabpanel"
                aria-labelledby="payrollSetup-tab"
              >
                <div class="card">
                  <div class="card-body">
                    <form action="">
                      <div class="row g-3">
                        <div class="col-12 col-lg-3">
                          <label for="dd_headType" class="form-label"
                            >Head Type&nbsp;<span class="text-danger"
                              >*</span
                            ></label
                          >
                          <select id="dd_headType" class="form-select select2">
                            <option disabled selected>
                              -- Select Head Type --
                            </option>
                            <option>Head Type 1</option>
                            <option>Head Type 2</option>
                            <option>Head Type 3</option>
                            <option>Head Type 4</option>
                            <option>Head Type 5</option>
                          </select>
                        </div>

                        <div class="col-12 col-lg-3">
                          <label for="dd_payHead" class="form-label"
                            >Pay Head&nbsp;<span class="text-danger"
                              >*</span
                            ></label
                          >
                          <select id="dd_payHead" class="form-select select2">
                            <option disabled selected>
                              -- Select Pay Head --
                            </option>
                            <option>Pay Head 1</option>
                            <option>Pay Head 2</option>
                            <option>Pay Head 3</option>
                            <option>Pay Head 4</option>
                            <option>Pay Head 5</option>
                          </select>
                        </div>
                        <div class="col-12 col-lg-3">
                          <label for="tb_amount" class="form-label"
                            >Amount&nbsp;<span class="text-danger"
                              >*</span
                            ></label
                          >
                          <input
                            id="tb_amount"
                            type="number"
                            class="form-control"
                            placeholder="Amount"
                          />
                        </div>
                        <div class="col-12 col-lg-3 d-flex">
                          <button
                            id="btn_addPayroll"
                            type="button"
                            class="mt-auto btn btn-success rounded-pill w-75"
                          >
                            ADD
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <table id="tbl_payroll" class="mt-3 table table-hover">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Head Type</th>
                      <th>Pay Head</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>

              <!-- Leave Quota -->
              <div
                class="tab-pane fade"
                id="leaveQuota"
                role="tabpanel"
                aria-labelledby="leaveQuota-tab"
              >
                <div class="card">
                  <div class="card-body">
                    <form action="">
                      <div class="row g-3">
                        <div class="col-12 col-lg-4">
                          <label for="dd_leaveType" class="form-label"
                            >Leave Type&nbsp;<span class="text-danger"
                              >*</span
                            ></label
                          >
                          <select id="dd_leaveType" class="form-select select2">
                            <option disabled selected>
                              -- Select leave Type --
                            </option>
                            <option>casual leave 1</option>
                            <option>leave 2</option>
                            <option>Head Type 3</option>
                            <option>Head Type 4</option>
                            <option>Head Type 5</option>
                          </select>
                        </div>

                        <div class="col-12 col-lg-4">
                          <label for="tb_numberOfDays" class="form-label"
                            >Number Of Days&nbsp;<span class="text-danger"
                              >*</span
                            ></label
                          >
                          <input
                            id="tb_numberOfDays"
                            type="number"
                            class="form-control"
                            placeholder="Amount"
                          />
                        </div>

                        <div class="col-12 col-lg-4 d-flex">
                          <button
                            id="btn_addLeave"
                            type="button"
                            class="mt-auto btn btn-success rounded-pill"
                          >
                            ADD
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

                <table id="tbl_leave" class="mt-3 table table-hover">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Leave Type</th>
                      <th>No Of Days</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function () {
        let payrollCount = 0;
        let leaveCount = 0;

        $("#btn_addPayroll").click(function () {
          let headType = $("#dd_headType").val();
          let payHead = $("#dd_payHead").val();
          let amount = $("#tb_amount").val();
          if (headType && payHead && amount) {
            payrollCount++;
            $("#tbl_payroll tbody").append(
              `<tr><td>${payrollCount}</td><td>${headType}</td><td>${payHead}</td><td>${amount}</td>
              <td><button class='btn btn-danger btn-sm deleteRow'><span class="material-icons">delete</span></button></td></tr>`
            );
            // rest form
            $("#dd_headType").val(null).trigger('change');
            $("#dd_payHead").val(null).trigger('change');
            $("#tb_amount").val("");
          }


        });

        $("#btn_addLeave").click(function () {
          let leaveType = $("#dd_leaveType").val();
          let days = $("#tb_numberOfDays").val();
          if (leaveType && days) {
            leaveCount++;
            $("#tbl_leave tbody").append(
              `<tr><td>${leaveCount}</td><td>${leaveType}</td><td>${days}</td>
              <td><button class='btn btn-danger btn-sm deleteRow'><span class="material-icons">delete</span></button></td></tr>`
            );
            $("#dd_leaveType").val(null).trigger('change')
            $("#tb_numberOfDays").val('')
          }
        });

        $(document).on("click", ".deleteRow", function () {
          $(this).closest("tr").remove();
        });

        $("#addEmployeeModal form").submit(function (e) {
          e.preventDefault();
          alert("All forms submitted successfully!");
          $("#addEmployeeModal").modal("hide");
        });
      });
    </script>

    <script>
      $(document).ready(function () {
        $(".select2").select2({
          width: "100%",
          dropdownParent: $("#addEmployeeModal"),
        });
      });
    </script>
  </body>
</html>
