<table id="usersTable" class="table table-hover">
    <thead>
        <tr>
            <th>Present</th>
            <th>Employee</th>
            <th>Department</th>
            <th>Designation</th>
        </tr>
    </thead>
    <tbody>
        <form action="{{ route('attendances.store') }}" method="post" id="myForm">
            @csrf
            @foreach ($usersWithoutAttendance as $user)
                <tr>
                    {{-- <td>
                <input type="checkbox" name="employees[]" value="{{ $user->id }}" class="form-check-input"
                    @checked(true) />
            </td> --}}
                    <td>
                        <!-- Hidden input ensures unchecked employees are sent as "absent" -->
                        <input type="hidden" name="employees[{{ $user->id }}]" value="absent">
                        <input type="checkbox" name="employees[{{ $user->id }}]" value="present"
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
