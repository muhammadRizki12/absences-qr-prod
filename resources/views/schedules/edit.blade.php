<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Jadwal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
                <div class="container mt-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4>Edit Jadwal</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('schedule.update', $schedule->id) }}" method="post">
                                @csrf
                                @method('PATCH')

                                <!-- Mata Pelajaran -->
                                <div class="mb-3">
                                    <label for="study" class="form-label">Mata Pelajaran</label>
                                    <input type="text" name="study" id="study" class="form-control" value="{{ $schedule->study }}" required>
                                </div>

                                <!-- Pilih Guru -->
                                <div class="mb-3">
                                    <label for="users" class="form-label">Pilih Guru</label>
                                    <select name="user_id" id="users" class="form-select" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $user->id == $schedule->user_id ? 'selected' : '' }}>
                                                {{ $user->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Pilih Kelas -->
                                <div class="mb-3">
                                    <label for="classes" class="form-label">Pilih Kelas</label>
                                    <select name="class_id" id="classes" class="form-select" required>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}" {{ $class->id == $schedule->class_id ? 'selected' : '' }}>
                                                {{ $class->class_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Pilih Hari -->
                                <div class="mb-3">
                                    <label for="day" class="form-label">Pilih Hari</label>
                                    <select name="day" id="day" class="form-select" required>
                                        <option value="">--Pilih Hari--</option>
                                        <option value="Senin" {{ $schedule->day == 'Senin' ? 'selected' : '' }}>Senin</option>
                                        <option value="Selasa" {{ $schedule->day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                        <option value="Rabu" {{ $schedule->day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                        <option value="Kamis" {{ $schedule->day == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                        <option value="Jumat" {{ $schedule->day == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    </select>
                                </div>

                                <!-- Jam Masuk -->
                                <div class="mb-3">
                                    <label for="entry_time" class="form-label">Jam Masuk</label>
                                    <input type="time" name="entry_time" id="entry_time" class="form-control" value="{{ $schedule->entry_time }}" required>
                                </div>

                                <!-- Jam Keluar -->
                                <div class="mb-3">
                                    <label for="out_time" class="form-label">Jam Keluar</label>
                                    <input type="time" name="out_time" id="out_time" class="form-control" value="{{ $schedule->out_time }}" required>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
