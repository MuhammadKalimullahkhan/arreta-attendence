<aside>
    <header>
        <img src="{{ asset('logo.jpg') }}" alt="logo" width="150">
    </header>

    <div class="content">
        <ul>
            <x-sidebar-link route="dashboard" icon="home-outline" text="Dashboard" />
            <x-sidebar-link route="attendances.index" icon="calendar-outline" text="Attendance" />
            <x-sidebar-link route="leave.index" icon="newspaper-outline" text="Leave" />
            <x-sidebar-link route="users.index" icon="people-outline" text="Users" />
            <x-sidebar-link route="departments.index" icon="business-outline" text="Departments" />
            <x-sidebar-link route="designations.index" icon="prism-outline" text="Designation" />
            <x-sidebar-link route="roles.index" icon="lock-closed-outline" text="Roles" />
            <x-sidebar-link route="pay-heads.index" icon="cash-outline" text="Payhead" />
            <x-sidebar-link route="users.attendance" :params="['id' => auth()->id()]" icon="document-text-outline"
                text="Attendance Report" />
            <x-sidebar-link route="employee.index" icon="document-text-outline" text="Employee Info" />
        </ul>
    </div>



    <footer>
        <ul>
            <x-sidebar-link route="users.profile" icon="person-circle-outline" text="Profile" />
        </ul>
    </footer>
</aside>
