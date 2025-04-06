@extends('layout.base')

@section('mainContent')
    <section class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="sectionTitle">
                Pay role
                <small class="text-muted">List of all Pay role</small>
            </h1>
            <div class="d-print-none">
                <button id="btn_print" class="btn btn-primary" onclick="window.print()" title="Print Current Salary Setup">
                    <i class="fa-solid fa-print"></i> Print
                </button>
            </div>
        </div>
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="col-12">
                <div class="card parent">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="d-print-none col-12">
                                <label>Filters</label>
                            </div>
                            <div class="col-3">
                                <label for="userFilter">Users</label>
                                <select id="userFilter" class="form-select select2">
                                    <option value="0" selected> All Users</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="departmentFilter">Departments</label>
                                <select id="departmentFilter" class="form-select select2">
                                    <option value="0" selected>All Departments</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="yearFilter">Year</label>
                                <select id="yearFilter" class="form-select select2">
                                    <option value="0" disabled>-- Select Year --</option>
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="monthFilter">Month</label>
                                <select id="monthFilter" class="form-select select2">
                                    <option value="0" disabled>-- Select Month --</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04" selected>Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                            </div>
                            {{-- <div class="d-print-none col d-flex flex-col">
                                <button id="btn_filter" type="submit" class="mt-auto btn btn-primary w-100"
                                    onclick="loadTableData()">Process</button>
                            </div> --}}
                            <div class="col-12 mt-3">
                                <div class="table-responsive">
                                    <table id="tbl_payroll" class="table table-hover">
                                        <thead></thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('scripts')
    <script src="/js/utils.js"></script>
    <script>
        let payrollData = {};
        let earningsColumns;
        let deductionsColumns;
        let basicPay = 0;


        function loadTableData() {
            payrollData = {};
            earningsColumns = [];
            deductionsColumns = [];
            basicPay = 0;

            let url = '{{ route('payroll.store') }}';

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    department_id: $("#departmentFilter").val(),
                    user_id: $("#userFilter").val(),
                    year: $("#yearFilter").val(),
                    month: $("#monthFilter").val(),
                },
                success: function(response) {
                    console.log(response);
                    if (response.success && response.data.length > 0) {
                        generatePayrollTable(response.data[0]); // payrolls passed here
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
                        dangerAlert("Failed", "Failed to update the role.");
                    }
                }
            });
        }

        function generatePayrollTable(data) {
            let earningsHeaders = new Map();
            let deductionsHeaders = new Map();

            // Process data
            data.forEach(item => {
                if (!payrollData[item.EmpID]) {
                    payrollData[item.EmpID] = {
                        empID: item.EmpID,
                        name: item.name,
                        department: item.department,
                        designation: item.designation,
                        earnings: {},
                        deductions: {},
                        leaveCount: item.l_counts,
                    };
                }

                if (item.pay_head_type.toLowerCase() === "earnings") {
                    payrollData[item.EmpID].earnings[item.pay_head] = {
                        amount: parseFloat(item.amount),
                        isEditable: item.is_editable,
                        headId: item.pay_head_id
                    };
                    earningsHeaders.set(item.pay_head_id, {
                        payHead: item.pay_head,
                        id: item.pay_head_id
                    });
                } else if (item.pay_head_type.toLowerCase() === "deductions") {
                    payrollData[item.EmpID].deductions[item.pay_head] = {
                        amount: parseFloat(item.amount),
                        isEditable: item.is_editable,
                        headId: item.pay_head_id
                    };
                    deductionsHeaders.set(item.pay_head_id, {
                        payHead: item.pay_head,
                        id: item.pay_head_id
                    });
                }
            });

            // Convert headers to arrays for ordered iteration
            earningsColumns = Array.from(earningsHeaders.values());
            deductionsColumns = Array.from(deductionsHeaders.values());

            // Build table headers dynamically
            let tableHead = $("#tbl_payroll thead");
            tableHead.empty();

            let headerRow1 =
                `<tr>
                    <th colspan="2" style="border: 1px solid var(--color-border);">Personal Information</th>
                    <th colspan="${earningsColumns.length}" style="border: 1px solid var(--color-border); background-color: #e4f0fa;">Earnings</th>
                    <th colspan="${deductionsColumns.length+1}" style="border: 1px solid var(--color-border); background-color: #fae4e4;">Deductions</th>
                    <th style="border: 1px solid var(--color-border);">Gross Salary</th>
                </tr>`;

            let headerRow2 =
                `<tr>
                    <th>Employee Name</th>
                    <th>Department</th>
                    ${earningsColumns.map(col => `<th>${col.payHead}</th>`).join("")}
                    ${deductionsColumns.map(col => `<th>${col.payHead}</th>`).join("")}
                    <th>Leaves</th>
                    <th>Gross Salary</th>
                </tr>`;

            // Creating table headers
            tableHead.append(headerRow1);
            tableHead.append(headerRow2);

            // Build table body dynamically
            let tableBody = $("#tbl_payroll tbody");
            tableBody.empty();

            Object.values(payrollData).forEach(emp => {
                let earningsTotal = 0;
                let deductionsTotal = 0;

                let row = `<tr><td>${emp.name}<small class='d-block text-muted'>${emp.designation}</small></td>`;
                row += `<td>${emp.department}</td>`;

                // Populate earnings columns
                earningsColumns.forEach(col => {
                    let val = emp.earnings[col.payHead];

                    col.payHead == 'Basic Pay' ? basicPay = val?.amount : '';

                    let inputId = `E${col.id}_${emp.empID}`;
                    if (val?.isEditable == 1) {
                        row +=
                            `<td><input type="number" id="${inputId}" value="${val?.amount.toFixed() || '0.00'}" class="form-control earnings-input"/></td>`;
                    } else {
                        row += `<td><span id="${inputId}">${val?.amount.toFixed() || '0.00'}</span></td>`;
                    }
                    earningsTotal += val?.amount || 0;
                });

                // Populate deductions columns
                deductionsColumns.forEach(col => {
                    let val = emp.deductions[col.payHead];
                    let inputId = `D${col.id}_${emp.empID}`;
                    if (val?.isEditable == 1) {
                        row +=
                            `<td><input type="number" id="${inputId}" value="${val?.amount.toFixed() || '0.00'}" class="form-control deductions-input"/></td>`;
                    } else {
                        row += `<td><span id="${inputId}">${val?.amount.toFixed() || '0.00'}</span></td>`;
                    }
                    deductionsTotal += val?.amount || 0;
                });

                let leavesDeduction = (basicPay / 30) * emp.leaveCount;
                let grossSalary = earningsTotal - (deductionsTotal + leavesDeduction);

                row += `<td id="L_${emp.empID}" title="Total Leaves : ${emp.leaveCount} Days">
                    ${leavesDeduction.toFixed()} <small class='text-muted'>| ${emp.leaveCount}</small>
                </td>`;

                row += `<td id="G_${emp.empID}">
                    ${grossSalary.toFixed()}
                </td>
            </tr>`;

                tableBody.append(row);
            });

            // Attach event listeners for recalculating gross salary
            $(".earnings-input, .deductions-input").on("input", function() {
                let empID = $(this).attr("id").split("_")[1]; // Extract EmpID from ID
                reTotalGross(empID);
            });
        }

        // Function to recalculate gross salary when an input changes
        function reTotalGross(empID) {
            let earningsTotal = 0;
            let deductionsTotal = 0;
            let emp = payrollData[empID];
            let basicPay = 0;


            // Recalculate earnings
            earningsColumns.forEach(col => {
                let inputId = `E${col.id}_${empID}`;
                let val = emp.earnings[col.payHead];
                let value;
                if (val?.isEditable == 1) {
                    value = parseFloat($(`#${inputId}`).val()) || 0;

                } else {
                    value = parseFloat($(`#${inputId}`).text()) || 0;
                }
                col.payHead == 'Basic Pay' ? basicPay = value : '';
                emp.earnings[col.payHead].amount = value; // Update the amount in payrollData
                earningsTotal += value;
            });
            deductionsColumns.forEach(col => {
                let inputId = `D${col.id}_${empID}`;
                let value;
                let val = emp.deductions[col.payHead];
                if (val?.isEditable == 1) {
                    value = parseFloat($(`#${inputId}`).val()) || 0;
                } else {
                    value = parseFloat($(`#${inputId}`).text()) || 0;
                }
                emp.deductions[col.payHead].amount = value; // Update the amount in payrollData
                deductionsTotal += value;
            });

            // Calculate deductions for leaves
            let leavesDeduction = (basicPay / 30) * emp.leaveCount;
            let grossSalary = earningsTotal - (deductionsTotal + leavesDeduction);

            $(`#L_${empID}`).text(leavesDeduction.toFixed());
            $(`#G_${empID}`).text(grossSalary.toFixed());

            console.log(emp)
        }


        // Call function to load data when the page is ready
        $(document).ready(function() {
            loadTableData();

            $('.select2').on('select2:select select2:unselect', function(e) {
                loadTableData();
            });

        });
    </script>
@endsection
