@extends('layout.base')
@section('mainContent')
    <section class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="sectionTitle">
                Employees
                <small class="text-muted">List of all Employees</small>
            </h1>

            <button type="button" class="btn btn-primary btn-sm" onclick="openModal(null)">
                Add Employee
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
                                    <th>Role</th>
                                    <th>Designation</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role->description }}</td>
                                        <td>{{ $user->designation->description }}</td>
                                        <td>
                                            <x-action-dropdown itemId="{{ $user->id }}"
                                                route="{{ route('users.destroy', $user->id) }}" />
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
    <!-- Add Employee Modal -->
    <div class="modal fade parent" id="upsertModal" tabindex="-1" aria-labelledby="upsertModalLabel" aria-hidden="true">
        <div class="modal-lg modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="upsertModalLabel">
                        Add Employee
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tabs navigation -->
                    <ul class="nav nav-underline" id="modalTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="initialInfo-tab" data-bs-toggle="tab"
                                data-bs-target="#initialInfo" type="button" role="tab" aria-controls="initialInfo"
                                aria-selected="true">
                                Initial Info
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payrollSetup-tab" data-bs-toggle="tab"
                                data-bs-target="#payrollSetup" type="button" role="tab" aria-controls="payrollSetup"
                                aria-selected="false">
                                Payroll Setup
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="leaveQuota-tab" data-bs-toggle="tab" data-bs-target="#leaveQuota"
                                type="button" role="tab" aria-controls="leaveQuota" aria-selected="false">
                                Leave Quota
                            </button>
                        </li>
                    </ul>

                    <!-- Tabs content -->
                    <div class="tab-content mt-3" id="modalTabsContent">
                        <!-- Initial Info -->
                        <div class="tab-pane fade show active" id="initialInfo" role="tabpanel"
                            aria-labelledby="initialInfo-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form action="">
                                        <input type="hidden" id="currentId" />
                                        <div class="row g-3">
                                            <div class="col-12 col-lg-6">
                                                <label for="tb_name" class="form-label">
                                                    Name&nbsp;
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input id="tb_name" type="text" class="form-control"
                                                    placeholder="Niaz Ali" />
                                                @error('initialInfo.name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="tb_cnic" class="form-label">CNIC&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <input id="tb_cnic" type="text" class="form-control"
                                                    placeholder="15605-1234567-8" />
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="tb_contact" class="form-label">Contact&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <input id="tb_contact" type="text" class="form-control"
                                                    placeholder="0345-1234567" />
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="dd_department" class="form-label">Department&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <select id="dd_department" class="form-select select2">
                                                    <option disabled selected>
                                                        Select Department
                                                    </option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->id }}">
                                                            {{ $department->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <label for="dd_role" class="form-label">Role&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <select id="dd_role" class="form-select select2">
                                                    <option disabled selected>Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">
                                                            {{ $role->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-6">
                                                <label for="dd_designation" class="form-label">Designation&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <select id="dd_designation" class="form-select select2">
                                                    <option disabled selected>
                                                        Select Designation
                                                    </option>
                                                    @foreach ($designations as $designation)
                                                        <option value="{{ $designation->id }}">
                                                            {{ $designation->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Payroll Setup -->
                        <div class="tab-pane fade" id="payrollSetup" role="tabpanel" aria-labelledby="payrollSetup-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form action="">
                                        <div class="row g-3">
                                            <div class="col-12 col-lg-3">
                                                <label for="dd_headType" class="form-label">Head Type&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <select id="dd_headType" class="form-select select2">
                                                    <option disabled selected>
                                                        Select Head Type
                                                    </option>
                                                    @foreach ($headTypes as $headType)
                                                        <option value="{{ $headType->id }}">
                                                            {{ $headType->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-3">
                                                <label for="dd_payHead" class="form-label">Pay Head&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <select id="dd_payHead" class="form-select select2">
                                                    <option disabled selected>Select Pay Head</option>
                                                    @foreach ($payHeads as $payHead)
                                                        <option value="{{ $payHead->id }}">
                                                            {{ $payHead->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <label for="tb_amount" class="form-label">Amount&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <input id="tb_amount" type="number" class="form-control"
                                                    placeholder="Amount" />
                                            </div>
                                            <div class="col-12 col-lg-3 d-flex">
                                                <button id="btn_addPayroll" type="button"
                                                    class="mt-auto btn btn-success rounded-pill w-75"
                                                    onclick="addPayroll()">
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
                        <div class="tab-pane fade" id="leaveQuota" role="tabpanel" aria-labelledby="leaveQuota-tab">
                            <div class="card">
                                <div class="card-body">
                                    <form action="">
                                        <div class="row g-3">
                                            <div class="col-12 col-lg-4">
                                                <label for="dd_leaveType" class="form-label">Leave Type&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <select id="dd_leaveType" class="form-select select2">
                                                    <option disabled selected>
                                                        Select leave Type
                                                    </option>
                                                    @foreach ($leaveTypes as $leaveType)
                                                        <option value="{{ $leaveType->id }}">
                                                            {{ $leaveType->description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <label for="tb_numberOfDays" class="form-label">Number Of Days&nbsp;<span
                                                        class="text-danger">*</span></label>
                                                <input id="tb_numberOfDays" type="number" class="form-control"
                                                    placeholder="Amount" />
                                            </div>

                                            <div class="col-12 col-lg-4 d-flex">
                                                <button id="btn_addLeave" type="button"
                                                    class="mt-auto btn btn-success rounded-pill" onclick="addLeave()">
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
                <div class="modal-footer">
                    <button type="submit" id="btn_submit" class="btn btn-primary">Add Employee</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Employee Modal -->
@endsection

@section('scripts')
    <script src="/js/utils.js"></script>

    <script>
        let payrollSetup = [];
        let leaveQuota = [];
        let payrollCount = 0;
        let leaveCount = 0;

        $(document).ready(function() {

            // deleteLeave
            $(document).on("click", "#btn_deleteLeave", function() {
                if (leaveCount > 0)
                    leaveCount--;

                $(this).closest("tr").remove();
                leaveQuota.splice(leaveCount, 1);
            });

            // deletePayrollSetup
            $(document).on("click", "#btn_deletePayrollSetup", function() {
                if (payrollCount > 0)
                    payrollCount--;

                $(this).closest("tr").remove();
                payrollSetup.splice(payrollCount, 1);
            });

            // save button
            $("#btn_submit").click((e) => {
                sendRequest();
            });

        });

        function openModal(id = null) {
            payrollSetup = [];
            leaveQuota = [];
            leaveCount = 0;
            payrollCount = 0;
            $("#tbl_leave tbody").html("");
            $("#tbl_payroll tbody").html("");

            if (id) {
                // Edit mode
                $('.modal .modal-title').text('Edit Employee');
                $('#btn_submit').text('Update Employee');

                $.get('{{ route('users.index') }}' + '/' + id, function(response) {
                    if (response.success) {
                        const user = response.data[0]; // converts from snake to camel case.

                        // populate values to the users modal
                        // initial info
                        $('#currentId').val(user.id);
                        $("#tb_name").val(user.name);
                        $("#tb_cnic").val(user.cnic);
                        $("#tb_contact").val(user.contact);
                        $("#dd_department").val(user.department_id).trigger('change');
                        $("#dd_role").val(user.role_id).trigger('change');
                        $("#dd_designation").val(user.designation_id).trigger('change');

                        // papulating payroll setup
                        for (const payroll of user.payroll_setup) {
                            addPayrollSetupRow(payroll.pay_head_id, payroll.pay_head_type_id, payroll.amount);
                        }
                        for (const leave of user.leave_quota) {
                            addLeaveTypeRow(leave.leave_type_id, leave.number_of_days);
                        }
                    }
                });
            } else {
                // Create mode
                $('.modal .modal-title').text('Add Employee');
                $('#btn_submit').text('Add Employee');

                $('#currentId').val(null);
                $('#upsertModal form')[0].reset();
                $("#dd_department").val(1).trigger('change');
                $("#dd_role").val(1).trigger('change');
                $("#dd_designation").val(1).trigger('change');
            }
            $('#upsertModal').modal('show');
        }

        // send the data to the Server
        const sendRequest = () => {
            const initialInfo = collectInitialInfo();
            const formData = {
                initialInfo,
                payrollSetup,
                leaveQuota
            }

            let id = $('#currentId').val();
            let url = id ? '{{ route('users.index') }}/' + id : '{{ route('users.store') }}';
            let method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#upsertModal').modal('hide');
                        successAlert("Success", response.message); // Reload page to update data
                    }
                },
                error: function(xhr) {
                    dangerAlert("Failed", "Failed to update/create.");
                    console.error(xhr.responseText);
                }
            });
        }

        function addLeaveTypeRow(leaveType, days) {
            leaveQuota.push({
                leaveType,
                days
            });
            leaveCount++;

            const rowHtml = `
                <tr>
                    <td>${leaveCount}</td>
                    <td>${leaveType}</td>
                    <td>${days}</td>
                    <td>
                        <button id="btn_deleteLeave" class="btn btn-danger btn-sm">
                            <ion-icons class="trash">delete</ion-icons>
                        </button>
                    </td>
                </tr>`;

            $("#tbl_leave tbody").append(rowHtml);
        }

        const addLeave = () => {
            let leaveType = $("#dd_leaveType").val();
            let days = $("#tb_numberOfDays").val();
            if (leaveType && days) {
                leaveQuota.push({
                    leaveType,
                    days
                })
                leaveCount++;
                $("#tbl_leave tbody").append(
                    `<tr><td>${leaveCount}</td><td>${leaveType}</td><td>${days}</td>
                             <td><button id='btn_deleteLeave' class='btn btn-danger btn-sm'><span class="material-icons">delete</span></button></td></tr>`
                );
                $("#dd_leaveType").val(null).trigger("change");
                $("#tb_numberOfDays").val("");
            }
        }

        function addPayrollSetupRow(payHead, headType, amount) {
            payrollSetup.push({
                payHead,
                headType,
                amount
            });
            payrollCount++;

            const rowHtml = `
                <tr>
                    <td>${payrollCount}</td>
                    <td>${headType}</td>
                    <td>${payHead}</td>
                    <td>${amount}</td>
                    <td>
                        <button id="btn_deletePayrollSetup" class="btn btn-danger btn-sm">
                            <ion-icons class="trash">delete</ion-icons>
                        </button>
                    </td>
                </tr>`;

            $("#tbl_payroll tbody").append(rowHtml);
        }

        const addPayroll = () => {
            let headType = $("#dd_headType").val();
            let payHead = $("#dd_payHead").val();
            let amount = $("#tb_amount").val();

            if (headType && payHead && amount) {
                // add the current data to the payrollSetup array for later use.
                payrollSetup.push({
                    payHead,
                    headType,
                    amount
                });
                payrollCount++;

                $("#tbl_payroll tbody").append(
                    `<tr><td>${payrollCount}</td><td>${headType}</td><td>${payHead}</td><td>${amount}</td><td><button id='btn_deletePayrollSetup' class='btn btn-danger btn-sm'><ion-icons class="trash">delete</ion-icons></button></td>
                        </tr>`
                );
                // rest form
                $("#dd_headType").val("").trigger("change");
                $("#dd_payHead").val("").trigger("change");
                $("#tb_amount").val("");
            }
        }

        const collectInitialInfo = () => {

            const name = $("#tb_name").val();
            const cnic = $("#tb_cnic").val();
            const contact = $("#tb_contact").val();
            const department = $("#dd_department").val();
            const role = $("#dd_role").val();
            const designation = $("#dd_designation").val();

            return {
                name,
                cnic,
                contact,
                department,
                role,
                designation
            }
        }
    </script>
@endsection
