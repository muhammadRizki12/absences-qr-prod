@extends('layouts.admin')

@section('title', 'Update Laporan Kehadiran')

@section('content')

    <div class="container">
        <h3 class="mb-4">Update Status Kehadiran</h3>

        <!-- Form untuk Update Status -->
        <form action="{{ route('attendance_reports.update', $attendanceReport->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="text" class="form-control" id="date"
                    value="{{ \Carbon\Carbon::parse($attendanceReport->date)->format('d-m-Y') }}" disabled>
            </div>

            <div class="mb-3">
                <label for="teacher_name" class="form-label">Nama Guru</label>
                <input type="text" class="form-control" id="teacher_name" value="{{ $attendanceReport->teacher_name }}"
                    disabled>
            </div>

            <div class="mb-3">
                <label for="time" class="form-label">Waktu</label>
                <input type="text" class="form-control" id="time" value="{{ $attendanceReport->time }}" disabled>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status Kehadiran</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Hadir" {{ $attendanceReport->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="Tidak Hadir" {{ $attendanceReport->status == 'Tidak Hadir' ? 'selected' : '' }}>Tidak
                        Hadir</option>
                    <option value="Terlambat" {{ $attendanceReport->status == 'Terlambat' ? 'selected' : '' }}>Terlambat
                    </option>
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

@endsection
