<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Identitas Guru</title>
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
                        <a class="nav-link" href="#">Dashboard</a>
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
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                </ul>

                <h5 class="text-primary mt-3">MENU</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Scan QR Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Data Kehadiran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Jadwal</a>
                    </li>
                </ul>
            </div>


            <!-- Main Content -->
            <div class="col-md-9 col-12">
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h4>Edit Identitas Guru</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Form Edit Data Guru -->
                                    <form action="{{ route('dashboardGuru.update') }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nip" class="form-label">NIP</label>
                                            <input type="text" class="form-control" id="nip" name="nip" value="{{ $user->nip }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Jenis Kelamin</label>
                                            <select class="form-select" id="gender" name="gender" required>
                                                <option value="L" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="job_tier" class="form-label">Jenjang Jabatan</label>
                                            <input type="text" class="form-control" id="job_tier" name="job_tier" value="{{ $user->job_tier }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="rank" class="form-label">Pangkat</label>
                                            <input type="text" class="form-control" id="rank" name="rank" value="{{ $user->rank }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="grade" class="form-label">Golongan</label>
                                            <input type="text" class="form-control" id="grade" name="grade" value="{{ $user->grade }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="main_position" class="form-label">Jabatan Tugas Utama</label>
                                            <input type="text" class="form-control" id="main_position" name="main_position" value="{{ $user->main_position }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="additional_position" class="form-label">Jabatan Tugas Tambahan</label>
                                            <input type="text" class="form-control" id="additional_position" name="additional_position" value="{{ $user->additional_position }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-save"></i> Update Data
                                        </button>
                                    </form>
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
