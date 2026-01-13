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
            /* cerah */
            background-color: #0d6efd;
            color: white;
            padding: 20px;
        }

        .bg-sidebar .nav-link {
            color: white;
        }
    </style>
    @stack('styles')
</head>
{{-- End Header --}}

<body>
    @yield('navbar')

    <div class="container-fluid">
        @hasSection('sidebar')
            <div class="row">
                <aside class="col-md-2 bg-sidebar p-3 d-none d-md-block min-vh-100">
                    @yield('sidebar')
                </aside>
                <main class="col-md-10 col-12 py-4">
                    @yield('content')
                </main>
            </div>
        @else
            <main class="py-4">
                @yield('content')
            </main>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
