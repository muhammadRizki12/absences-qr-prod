@extends('layouts.admin')

@section('title', 'Jadwal')

@section('content')

    <div class="container col-md-11">
        <h3 class="mb-4">Jadwal</h3>

        @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('msg') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tombol "Tambah Schedule" di atas tabel -->
        <div class="text-end mb-3">
            <a href="{{ route('schedule.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Schedule
            </a>
        </div>

        <!-- Tabel Jadwal -->
        <table class="table text-center table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Guru</th>
                    <th scope="col">Mata pelajaran</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Waktu</th>

                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $schedule->class->class_name }}</td>
                        <td>{{ $schedule->user->username }}</td>
                        <td>{{ $schedule->study }}</td>
                        <td>{{ $schedule->day }}</td>
                        <td>{{ substr($schedule->entry_time, 0, 5) }} -
                            {{ substr($schedule->out_time, 0, 5) }}
                        </td>
                        <td>
                            <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
