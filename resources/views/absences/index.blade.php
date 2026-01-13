@extends('layouts.admin')

@section('title', 'Data Absensi')

@section('content')
    <div class="container">
        <h3 class="mb-4">Laporan Kehadiran</h3>

        <form method="GET" action="{{ route('absence.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-2">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}"
                        placeholder="Tanggal">
                </div>
                <div class="col-md-2">
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
                        <option value="Hadir" {{ request('status') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="Terlambat" {{ request('status') == 'Terlambat' ? 'selected' : '' }}>
                            Terlambat</option>
                        <option value="Tidak hadir" {{ request('status') == 'Tidak hadir' ? 'selected' : '' }}>Tidak hadir
                        </option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Filter</button>
        </form>

        <table class="table text-center table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Guru</th>
                    <th scope="col">Mata Pelajaran</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absences as $absence)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $absence->schedule->day }}, {{ $absence->date }}</td>
                        <td>{{ $absence->schedule->user->username }}</td>
                        <td>{{ $absence->schedule->study }}</td>
                        <td>{{ $absence->schedule->class->class_name }}</td>
                        <td>{{ substr($absence->time, 0, 5) }}</td>
                        <td>{{ $absence->status }}</td>
                        <td>
                            <a href="{{ route('absence.edit', $absence->id) }}" class="btn btn-warning btn-sm btn-icon"
                                title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('absence.destroy', $absence->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
