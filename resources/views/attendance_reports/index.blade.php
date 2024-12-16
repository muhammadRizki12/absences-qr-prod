<!-- resources/views/attendance_reports/index.blade.php -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Laporan Kehadiran</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .btn-container {
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
        <h3 class="mb-4">Laporan Kehadiran Guru</h3>

        <!-- Form Pencarian dan Filter -->
        <form method="GET" action="{{ route('attendance_reports.index') }}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="teacher_name" placeholder="Nama Guru" value="{{ request('teacher_name') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="status">
                        <option value="">-- Status --</option>
                        <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="Tidak Hadir" {{ request('status') == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </div>
        </form>

        <!-- Tabel Laporan Kehadiran -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Guru</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendanceReports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($report->date)->format('d-m-Y') }}</td>
                            <td>{{ $report->user_id }}</td>
                            <td>{{ $report->time }}</td>
                            <td>{{ $report->status }}</td>
                            <td>
                                <!-- Form untuk mengedit status -->
                                <form action="{{ route('attendance_reports.updateStatus', $report->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                        <option value="Hadir" {{ $report->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="Tidak Hadir" {{ $report->status == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>
