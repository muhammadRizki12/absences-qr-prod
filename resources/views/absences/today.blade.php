@extends('layouts.admin')

@section('title', 'Laporan Kehadiran Hari ini')

@section('content')

    <div class="container">
        <h3 class="mb-4">Laporan Kehadiran Hari ini</h3>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('absence.today') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="teacher_name" class="form-control" value="{{ request('teacher_name') }}"
                        placeholder="Nama Guru">
                </div>
                <div class="col-md-3">
                    <input type="text" name="study" class="form-control" value="{{ request('study') }}"
                        placeholder="Mata Pelajaran">
                </div>
                <div class="col-md-2">
                    <input type="text" name="class_name" class="form-control" value="{{ request('class_name') }}"
                        placeholder="Kelas">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">Status</option>
                        <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir
                        </option>
                        <option value="Terlambat" {{ request('status') == 'Terlambat' ? 'selected' : '' }}>
                            Terlambat</option>
                        <option value="Tidak hadir" {{ request('status') == 'Tidak hadir' ? 'selected' : '' }}>Tidak hadir
                        </option>
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
                                <a href="{{ route('absence.edit', $absence->id) }}" class="btn btn-warning btn-sm btn-icon"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Form untuk menghapus data dengan ikon tong sampah -->
                                <form action="{{ route('absence.destroy', $absence->id) }}" method="POST"
                                    style="display:inline;">
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

@endsection
