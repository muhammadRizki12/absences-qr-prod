<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit User</title>
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

        .table th, .table td {
            vertical-align: middle;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .navbar-nav .nav-link {
            padding-right: 1.5rem;
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
                        <a class="nav-link active" href="/users">Data Guru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/classes">Kelas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/schedules">Jadwal</a>
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
                        <a class="nav-link" href="/schedules">Jadwal</a>
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
                        <div class="card-header">
                            <h4>Update Data Guru</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <!-- NIP -->
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP:</label>
                                    <input type="text" id="nip" name="nip" value="{{ $user->nip }}"
                                        class="form-control" required>
                                </div>

                                <!-- Username -->
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nama:</label>
                                    <input type="text" id="username" name="username" value="{{ $user->username }}"
                                        class="form-control" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                                        class="form-control" required>
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" id="password" name="password"
                                        placeholder="Leave blank to keep current password" class="form-control">
                                </div>

                                <!-- Gender -->
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin:</label>
                                    <select id="gender" name="gender" class="form-select" required>
                                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Laki-Laki
                                        </option>
                                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>

                                <!-- Rank -->
                                <div class="mb-3">
                                    <label for="rank" class="form-label">Pangkat:</label>
                                    <input type="text" id="rank" name="rank" value="{{ $user->rank }}"
                                        class="form-control">
                                </div>

                                <!-- Grade -->
                                <div class="mb-3">
                                    <label for="grade" class="form-label">Golongan:</label>
                                    <input type="text" id="grade" name="grade" value="{{ $user->grade }}"
                                        class="form-control">
                                </div>

                                <!-- Job Tier -->
                                <div class="mb-3">
                                    <label for="job_tier" class="form-label">Jenjang Jabatan:</label>
                                    <input type="text" id="job_tier" name="job_tier"
                                        value="{{ $user->job_tier }}" class="form-control">
                                </div>

                                <!-- Main Position -->
                                <div class="mb-3">
                                    <label for="main_position" class="form-label">Jabatan Utama:</label>
                                    <input type="text" id="main_position" name="main_position"
                                        value="{{ $user->main_position }}" class="form-control">
                                </div>

                                <!-- Additional Position -->
                                <div class="mb-3">
                                    <label for="additional_position" class="form-label">Jabatan Tambahan:</label>
                                    <input type="text" id="additional_position" name="additional_position"
                                        value="{{ $user->additional_position }}" class="form-control">
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

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
