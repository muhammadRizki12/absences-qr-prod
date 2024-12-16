<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mengajar Guru</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Halo Guru - SMK Negeri 1 Soreang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- MENU Section moved here for mobile -->
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard-guru">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/absences/scan-qr">Scan QR Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/absences">Data Kehadiran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/schedules">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="{{ route('auth.logout') }}">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar for Desktop Only -->
            <div class="col-md-3 bg-light p-3 d-none d-md-block">
                <!-- Tampilkan hanya di perangkat desktop -->
                <h5 class="text-primary">HOME</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard-guru">Dashboard</a>
                    </li>
                </ul>

                <h5 class="text-primary mt-3">MENU</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/users/absences/scan-qr">Scan QR Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/absences">Data Kehadiran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/schedules">Jadwal</a>
                    </li>
                </ul>
            </div>
            <!-- Main Content -->
            <div class="col-md-9 col-12">
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h4>Jadwal Guru</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Table for Jadwal Mengajar -->
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Kelas</th>
                                                <th>Hari</th>
                                                <th>Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($schedules as $schedule)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $schedule->study }}</td>
                                                    <td>{{ $schedule->class->class_name }}</td>
                                                    <td>{{ $schedule->day }}</td>
                                                    <td>{{ substr($schedule->entry_time, 0, 5) }} -
                                                        {{ substr($schedule->out_time, 0, 5) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End of Main Content -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
