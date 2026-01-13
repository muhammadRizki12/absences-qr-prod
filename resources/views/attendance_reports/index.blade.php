@extends('layouts.admin')

@section('title', 'Laporan Kehadiran Guru')

@section('content')

    <div class="container col-md-10">
        <h3 class="mb-4">Laporan Kehadiran Guru</h3>

        <!-- Form Pencarian dan Filter -->
        <form method="GET" action="{{ route('attendance_reports.index') }}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <input type="text" class="form-control" name="teacher_name" placeholder="Nama Guru"
                        value="{{ request('teacher_name') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="status">
                        <option value="">-- Status --</option>
                        <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="Tidak Hadir" {{ request('status') == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir
                        </option>
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
                                <form action="{{ route('attendance_reports.updateStatus', $report->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <select name="status" class="form-control form-control-sm"
                                        onchange="this.form.submit()">
                                        <option value="Hadir" {{ $report->status == 'Hadir' ? 'selected' : '' }}>Hadir
                                        </option>
                                        <option value="Tidak Hadir"
                                            {{ $report->status == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
