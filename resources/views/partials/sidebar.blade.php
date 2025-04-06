<aside>
    <header>
        <img src="{{ asset('logo.jpg') }}" alt="logo" width="150">
    </header>

    <div class="content">
        <ul>
            <x-sidebar-link route="dashboard" icon="fa-solid fa-house" text="Dashboard" />
            <x-sidebar-link route="attendances.index" icon="fa-solid fa-calendar-check" text="Attendance" />
            <x-sidebar-link route="leave.index" icon="fa-solid fa-file-lines" text="Leave" />
            <x-sidebar-link route="users.index" icon="fa-solid fa-users" text="Employees" />
            <x-sidebar-link route="departments.index" icon="fa-solid fa-building" text="Departments" />
            <x-sidebar-link route="designations.index" icon="fa-solid fa-id-badge" text="Designation" />
            <x-sidebar-link route="roles.index" icon="fa-solid fa-user-shield" text="Roles" />
            <x-sidebar-link route="pay-heads.index" icon="fa-solid fa-money-check-dollar" text="Payhead" />
            <x-sidebar-link route="users.attendance" :params="['id' => auth()->id()]" icon="fa-solid fa-clipboard-list"
                text="Attendance Report" />
            {{-- <x-sidebar-link route="employee.index" icon="fa-solid fa-id-card" text="Employee Info" /> --}}
            <x-sidebar-link route="payroll.index" icon="fa-solid fa-file-invoice-dollar" text="Payroll" />
        </ul>
    </div>



    <footer>
        <ul>
            <x-sidebar-link route="users.profile" icon="fa-user-circle" text="Profile" />
        </ul>
    </footer>
</aside>
