<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Absensi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling untuk sidebar */
        .bg-sidebar {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
        }

        /* Styling untuk link di sidebar */
        .bg-sidebar .nav-link {
            color: white;
        }

        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        .btn-container {
            text-align: right;
            margin-bottom: 20px;
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
                        <a class="nav-link " href="/classes">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/schedules">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/absences">Laporan Kehadiran</a>
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
            <div class="col-md-3 bg-sidebar p-3 d-none d-md-block">

                <h5>HOME</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/dashboardadmin">Dashboard</a>
                    </li>
                </ul>

                <h5>ADMIN</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Data Guru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/classes">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/schedules">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/absences">Laporan Kehadiran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-12 col-md-9">
                <div class="container">
                    <h3 class="mb-4">Laporan Kehadiran Hari ini</h3>

                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('absence.today') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="teacher_name" class="form-control"
                                    value="{{ request('teacher_name') }}" placeholder="Nama Guru">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="study" class="form-control"
                                    value="{{ request('study') }}" placeholder="Mata Pelajaran">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="class_name" class="form-control"
                                    value="{{ request('class_name') }}" placeholder="Kelas">
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="">Status</option>
                                    <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir
                                    </option>
                                    <option value="Terlambat" {{ request('status') == 'Terlambat' ? 'selected' : '' }}>
                                        Terlambat</option>
                                    <option value="Tidak hadir"
                                        {{ request('status') == 'Tidak hadir' ? 'selected' : '' }}>Tidak hadir</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Filter</button>
                    </form>

                    <!-- Tabel Data Absensi -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Guru</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Nama Kelas</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absences as $absence)
                                    <tr>
                                        <td>{{ $absence->schedule->user->username }}</td>
                                        <td>{{ $absence->schedule->study }}</td>
                                        <td>{{ $absence->schedule->class->class_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($absence->absence_datetime)->format('H:i') }}</td>
                                        <td>{{ $absence->status }}</td>
                                        <td>
                                            <!-- Tombol Edit (ikon pensil) -->
                                            <a href="{{ route('absence.edit', $absence->id) }}"
                                                class="btn btn-warning btn-sm btn-icon" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- Form untuk menghapus data dengan ikon tong sampah -->
                                            <form action="{{ route('absence.destroy', $absence->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-icon"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                    title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
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
