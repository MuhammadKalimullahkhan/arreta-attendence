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
        <form action="{{ route('leave.store') }}" method="post" id="myForm">
            @csrf
            @foreach ($usersWithAttendance as $user)
                <tr>
                    <td>
                        <input type="hidden" name="employees[{{ $user->id }}]" value="casual">
                        <input type="checkbox" name="employees[{{ $user->id }}]" value="paid"
                            class="form-check-input" @checked(true) />
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->department->description }}</td>
                    <td>{{ $user->designation->description }}</td>
                </tr>
            @endforeach
        </form>

    </tbody>
</table>
