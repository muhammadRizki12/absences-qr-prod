@extends('layouts.guru')

@section('title', 'Edit Dashboard Guru')

@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Edit Identitas Guru</h4>
                    </div>
                    <div class="card-body">
                        <!-- Form Edit Data Guru -->
                        <form action="{{ route('dashboardGuru.update') }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="username" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ $user->username }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nip" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip"
                                    value="{{ $user->nip }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="L" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="P" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="job_tier" class="form-label">Jenjang Jabatan</label>
                                <input type="text" class="form-control" id="job_tier" name="job_tier"
                                    value="{{ $user->job_tier }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="rank" class="form-label">Pangkat</label>
                                <input type="text" class="form-control" id="rank" name="rank"
                                    value="{{ $user->rank }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="grade" class="form-label">Golongan</label>
                                <input type="text" class="form-control" id="grade" name="grade"
                                    value="{{ $user->grade }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="main_position" class="form-label">Jabatan Tugas Utama</label>
                                <input type="text" class="form-control" id="main_position" name="main_position"
                                    value="{{ $user->main_position }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="additional_position" class="form-label">Jabatan Tugas Tambahan</label>
                                <input type="text" class="form-control" id="additional_position"
                                    name="additional_position" value="{{ $user->additional_position }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save"></i> Update Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
