<!doctype html>
<html lang="en">

{{-- Header --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Absences QR')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include HTML5 QRCode scanner library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .bg-sidebar {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
        }

        .bg-sidebar .nav-link {
            color: white;
        }

        .bg-sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        /* Desktop sidebar spacing */
        @media (min-width: 992px) {
            .desktop-sidebar {
                position: sticky;
                top: 0;
                height: 100vh;
                overflow-y: auto;
            }
        }

        /* Mobile navbar styling */
        @media (max-width: 991.98px) {
            .navbar-nav .nav-link {
                padding: 0.75rem 1rem;
            }

            .navbar-text {
                font-size: 0.75rem;
                font-weight: 600;
                letter-spacing: 0.5px;
                text-transform: uppercase;
            }

            .navbar .btn-danger {
                margin: 0.5rem 1rem;
                width: calc(100% - 2rem);
            }
        }
    </style>
    @stack('styles')
</head>
{{-- End Header --}}

<body>
    @yield('navbar')

    <div class="container-fluid">
        {{-- @hasSection('sidebar') --}}
        <div class="row">
            <!-- Desktop Sidebar (hidden on mobile) -->
            <aside class="col-lg-2 bg-sidebar p-3 d-none d-lg-block desktop-sidebar">
                @yield('sidebar')
            </aside>

            <!-- Main Content -->
            <main class="col-lg-10 col-12 py-4">
                @yield('content')
            </main>
        </div>
        {{-- @else
            <main class="py-4">
                @yield('content')
            </main>
        @endif --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
