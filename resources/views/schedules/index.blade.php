<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Jadwal</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        .btn-container {
            text-align: right;
            margin-bottom: 10px;
        }

        .btn-icon {
            padding: 5px 10px;
            font-size: 18px;
        }

        table th,
        table td {
            vertical-align: middle;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Halo Admin - SMK Negeri 1 Soreang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/dashboardadmin">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Data Guru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/classes">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/schedules">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/absences">Laporan Kehadiran</a>
                    </li>
                    <!-- Tombol Logout -->
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

            <!-- Sidebar -->
            <div class="col-md-3 bg-light p-3 d-none d-md-block">
                <h5 class="text-primary">HOME</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/dashboardadmin">Dashboard</a>
                    </li>
                </ul>

                <h5 class="text-primary mt-3">ADMIN</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Data Guru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/classes">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/schedules">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/absences">Laporan Kehadiran</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-12 col-md-9">
                <div class="container">
                    <h3 class="mb-4">Jadwal</h3>

                    @if (session('msg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('msg') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Tombol "Tambah Schedule" di atas tabel -->
                    <div class="btn-container">
                        <a href="{{ route('schedule.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah Schedule
                        </a>
                    </div>

                    <!-- Tabel Jadwal -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Mata pelajaran</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Jam Waktu</th>
                                    <th scope="col">Guru</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $schedule->study }}</td>
                                        <td>{{ $schedule->day }}</td>
                                        <td>{{ substr($schedule->entry_time, 0, 5) }} -
                                            {{ substr($schedule->out_time, 0, 5) }}</td>
                                        <td>{{ $schedule->user->username }}</td>
                                        <td>{{ $schedule->class->class_name }}</td>
                                        <td>
                                            <a href="{{ route('schedule.edit', $schedule->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('schedule.destroy', $schedule->id) }}"
                                                method="POST" style="display:inline;"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
