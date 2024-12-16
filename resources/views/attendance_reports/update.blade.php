<!-- resources/views/attendance_reports/edit.blade.php -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Status Kehadiran</title>
    <style>
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
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Halo Admin - SMK Negeri 1 Soreang</a>
        </div>
    </nav>

    <div class="container">
        <h3 class="mb-4">Update Status Kehadiran</h3>

        <!-- Form untuk Update Status -->
        <form action="{{ route('attendance_reports.update', $attendanceReport->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="text" class="form-control" id="date" value="{{ \Carbon\Carbon::parse($attendanceReport->date)->format('d-m-Y') }}" disabled>
            </div>

            <div class="mb-3">
                <label for="teacher_name" class="form-label">Nama Guru</label>
                <input type="text" class="form-control" id="teacher_name" value="{{ $attendanceReport->teacher_name }}" disabled>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Waktu</label>
                <input type="text" class="form-control" id="time" value="{{ $attendanceReport->time }}" disabled>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status Kehadiran</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Hadir" {{ $attendanceReport->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Tidak Hadir" {{ $attendanceReport->status == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                    <option value="Terlambat" {{ $attendanceReport->status == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                </select>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('attendance_reports.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
