@extends('layouts.admin')

@section('title', 'Data Guru')

@section('content')
    <!-- Main Content -->
    <div class="col-12 col-md-9">
        <div class="container">
            <h3 class="mb-4">Data Guru SMK 1 Soreang</h3>

            <!-- Tombol "Tambah Data Guru" di atas tabel -->
            <div class="btn-container">
                <a href="{{ route('dataguru.create') }}" class="btn btn-success">Tambah Data Guru</a>
            </div>

            <!-- Tabel Data Guru -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama <br>NIP/NI PPPK</th>
                            <th scope="col">L/P</th>
                            <th scope="col">Jenjang Jabatan <br>Pangkat & Golongan</th>
                            <th scope="col">Jabatan Tugas Utama</th>
                            <th scope="col">Jabatan Tugas Tambahan</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th> <!-- Kolom aksi -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gurus as $guru)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $guru->nama }}</strong><br>
                                    {{ $guru->nip }}
                                </td>
                                <td>{{ $guru->jenis_kelamin }}</td>
                                <td>
                                    <strong>{{ $guru->jenjang_jabatan }}</strong><br>
                                    {{ $guru->pangkat_golongan }}
                                </td>
                                <td>{{ $guru->jabatan_tugas_utama }}</td>
                                <td>{{ $guru->jabatan_tugas_tambahan }}</td>
                                <td>{{ $guru->keterangan }}</td>
                                <td>
                                    <!-- Tombol Edit (ikon pensil) -->
                                    <a href="{{ route('dataguru.edit', $guru->id) }}"
                                        class="btn btn-warning btn-sm btn-icon" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Form untuk menghapus data dengan ikon tong sampah -->
                                    <form action="{{ route('dataguru.destroy', $guru->id) }}" method="POST"
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

            <!-- Tombol "Selengkapnya lihat di sini" -->
            <div class="mt-4 text-center">
                <a href="https://docs.google.com/spreadsheets/d/1WKsrrw9crQHSnC3cG4ejtSnuFacrPv3jtF0EjM9D14U/edit?gid=0#gid=0"
                    class="btn btn-primary" target="_blank">
                    Selengkapnya lihat di sini
                </a>
            </div>

        </div>
    </div>
@endsection
