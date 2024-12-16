<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Absensi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .sidebar {
            background-color: #f1f1f1;
            padding: 15px;
        }

        .form-container {
            margin-top: 30px;
            padding: 30px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-container {
            text-align: right;
        }

        .form-label {
            font-weight: bold;
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
                        <a class="nav-link active" href="/classes">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/schedules">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/absences">Laporan Kehadiran</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="container form-container">
                    <h3>Edit Absensi</h3>

                    <form action="{{ route('absence.update', $absence->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Nama Guru -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama Guru:</label>
                            <input type="text" id="username" name="username"
                                value="{{ $absence->schedule->user->username }}" class="form-control" disabled>
                        </div>

                        <!-- Mata Pelajaran -->
                        <div class="mb-3">
                            <label for="study" class="form-label">Mata pelajaran:</label>
                            <input type="text" id="study" name="study" value="{{ $absence->schedule->study }}"
                                class="form-control" disabled>
                        </div>

                        <!-- Kelas -->
                        <div class="mb-3">
                            <label for="class_name" class="form-label">Kelas:</label>
                            <input type="text" id="class_name" name="class_name"
                                value="{{ $absence->schedule->class->class_name }}" class="form-control" disabled>
                        </div>

                        <!-- Waktu dan Tanggal -->
                        <div class="mb-3">
                            <label for="absence_datetime" class="form-label">Waktu Tanggal:</label>
                            <input type="datetime-local" id="absence_datetime" name="absence_datetime"
                                class="form-control" value="{{ $absence->absence_datetime }}" required>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" id="status" name="status" value="{{ $absence->status }}"
                                class="form-control">
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        >
    </script>
</body>

</html>
