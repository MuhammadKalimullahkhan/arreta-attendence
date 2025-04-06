<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wazar Solutions & Services</title>

    <!-- styling -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/styles.css" />

    <!-- Js -->
    <script defer src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- HTMX --}}
    <script src="https://unpkg.com/htmx.org@1.9.5"></script>

    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <main>
        @include('partials.sidebar')

        <div id="content">
            <nav>
                <button id="burger-icon">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="ms-auto d-flex align-items-center">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-circle"></i>
                            <span class="visually-hidden">User</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="{{ route('users.profile') }}">
                                    <i class="fa-solid fa-user me-2"></i>
                                    Profile
                                </a>
                            </li>
                            {{-- <li><a class="dropdown-item" href="#">Settings</a></li> --}}

                            {{-- dropdown divider --}}
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('account.logout') }}" method="GET">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
            </nav>

            <div class="container px-4">
                @yield('mainContent')
            </div>
        </div>
    </main>

    <footer class="text-center text-muted p-4">
        <p>
            Developed By <a href="https://wazar.pk/" target="_blank">Wazar SS</a>
        </p>
    </footer>

    <script src="/js/app.js"></script>
    <script>
        // get CSRF from meta
        {{-- don't remove this, this is used by delete-button component --}}
        document.body.addEventListener('htmx:configRequest', (event) => {
            event.detail.headers['X-CSRF-TOKEN'] = "{{ csrf_token() }}";
        });
        {{-- don't remove this, this is used by all Ajax calls --}}
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
