<table id="usersTable" class="table table-hover">
    <thead>
        <tr>
            <th>Paid Leave</th>
            <th>Employee</th>
            <th>Department</th>
            <th>Designation</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($absentUsers as $leave)
            <tr>
                <td>
                    <input type="hidden" name="leaves_id[{{ $leave->id }}]" value="casual">
                    <input type="checkbox" name="leaves_id[{{ $leave->id }}]" value="paid" class="form-check-input"
                        @checked($leave->is_without_pay == false) />
                </td>
                <td>{{ $leave->name }}</td>
                <td>{{ $leave->department }}</td>
                <td>{{ $leave->designation }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <small class="d-block text-center text-muted">No employees found.</small>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
