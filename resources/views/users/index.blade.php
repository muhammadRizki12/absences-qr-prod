@extends('layouts.admin')

@section('title', 'Users')

@section('content')
    <!-- Main Content -->
    <div class="container">
        <h3 class="mb-4">Data Guru SMK 1 Soreang</h3>

        <!-- Menampilkan pesan kesalahan jika ada -->
        @if (session('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('msg') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <!-- Tombol "Tambah Data User" di atas tabel -->
        <div class="text-end mb-3">
            <a href="{{ route('user.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Data User
            </a>
        </div>

        <!-- Tabel Data User -->

        <table class="table text-center table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan Utama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nip }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->main_position }}</td>
                        <td>
                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-primary btn-sm btn-icon"
                                title="detail">
                                <i class="fas fa-info-circle"></i>
                            </a>

                            <!-- Form untuk menghapus data dengan ikon tong sampah -->
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
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
