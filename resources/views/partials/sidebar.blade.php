<aside>
    <header>
        <img src="{{ asset('logo.jpg') }}" alt="logo" width="150">
        {{-- <h5>
            <strong>Arreta</strong>
            <span style="font-size: 1.2rem">Pharmaceutical</span>
        </h5> --}}
    </header>

    <div class="content">
        <ul>
            <li>
                <a href="/">
                    <ion-icon name="home-outline"></ion-icon>
                    dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('attendances.index') }}">
                    <ion-icon name="calendar-outline"></ion-icon>
                    attandance
                </a>
            </li>
            <li>
                <a href="{{ route('leave.index') }}">
                    <ion-icon name="newspaper-outline"></ion-icon>
                    leave
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}">
                    <ion-icon name="people-outline"></ion-icon>
                    users
                </a>
            </li>
            <li>
                <a href="{{ route('departments.index') }}">
                    <ion-icon name="business-outline"></ion-icon>
                    departments
                </a>
            </li>
            <li>
                <a href="{{ route('designations.index') }}">
                    <ion-icon name="prism-outline"></ion-icon>
                    designation
                </a>
            </li>
            <li>
                <a href="{{ route('roles.index') }}">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    Roles
                </a>
            </li>
            <li>
                <a href="{{ route('pay-heads.index') }}">
                    <ion-icon name="cash-outline"></ion-icon>
                    Payhead
                </a>
            </li>
            <li>
                <a href="{{ route('attendances.attendance2') }}">
                    <ion-icon name="document-text-outline"></ion-icon>
                    attendance report
                </a>
            </li>
        </ul>
    </div>

    <footer>
        <ul>
            <li>
                <a href="profile">
                    <ion-icon name="person-circle-outline"></ion-icon>
                    profile
                </a>
            </li>
        </ul>
    </footer>
</aside>
