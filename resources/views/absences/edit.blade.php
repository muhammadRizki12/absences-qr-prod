@extends('layouts.admin')

@section('title', 'Absensi Edit')

@section('content')

    <!-- Main Content -->
    <div class="container col-md-10 mt-4">
        <h3>Edit Absensi</h3>

        <form action="{{ route('absence.update', $absence->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Nama Guru -->
            <div class="mb-3">
                <label for="username" class="form-label">Nama Guru:</label>
                <input type="text" id="username" name="username" value="{{ $absence->schedule->user->username }}"
                    class="form-control" disabled>
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
                <input type="text" id="class_name" name="class_name" value="{{ $absence->schedule->class->class_name }}"
                    class="form-control" disabled>
            </div>

            <!-- Waktu dan Tanggal -->
            <div class="mb-3">
                <label for="absence_datetime" class="form-label">Waktu Tanggal:</label>
                <input type="datetime-local" id="absence_datetime" name="absence_datetime" class="form-control"
                    value="{{ $absence->absence_datetime }}" required>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" id="status" name="status" value="{{ $absence->status }}" class="form-control">
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection
