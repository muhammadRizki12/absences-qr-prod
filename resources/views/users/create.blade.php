@extends('layouts.admin')

@section('title', 'Create Users')

@section('content')

    <!-- Main Content -->
    <div class="container col-md-10">
        <div class="card">
            <div class="card-header">
                <h4>Form Data Guru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select id="gender" name="gender" class="form-select" required>
                            <option value="Laki-Laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Rank -->
                    <div class="mb-3">
                        <label for="rank" class="form-label">Pangkat</label>
                        <input type="text" id="rank" name="rank" class="form-control">
                    </div>

                    <!-- Grade -->
                    <div class="mb-3">
                        <label for="grade" class="form-label">Golongan</label>
                        <input type="text" id="grade" name="grade" class="form-control">
                    </div>

                    <!-- Job Tier -->
                    <div class="mb-3">
                        <label for="job_tier" class="form-label">Jenjang Jabatan</label>
                        <input type="text" id="job_tier" name="job_tier" class="form-control">
                    </div>

                    <!-- Main Position -->
                    <div class="mb-3">
                        <label for="main_position" class="form-label">Jabatan Utama</label>
                        <input type="text" id="main_position" name="main_position" class="form-control">
                    </div>

                    <!-- Additional Position -->
                    <div class="mb-3">
                        <label for="additional_position" class="form-label">Jabatan Tambahan</label>
                        <input type="text" id="additional_position" name="additional_position" class="form-control">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
