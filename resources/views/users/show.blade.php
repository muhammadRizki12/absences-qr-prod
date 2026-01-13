@extends('layouts.admin')

@section('title', 'Edit Users')

@section('content')

    <!-- Main Content -->
    <div class="container col-md-10">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h4>Detail Data Guru</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- NIP -->
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP:</label>
                        <input type="text" id="nip" name="nip" value="{{ $user->username }}"
                            class="form-control" disabled>
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama:</label>
                        <input type="text" id="username" name="username" value="{{ $user->username }}"
                            class="form-control" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control"
                            required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password"
                            placeholder="Leave blank to keep current password" class="form-control">
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label for="gender" class="form-label">Jenis Kelamin:</label>
                        <select id="gender" name="gender" class="form-select" required>
                            <option value="Laki-laki" {{ $user->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="Perempuan" {{ $user->gender == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    <!-- Main Position -->
                    <div class="mb-3">
                        <label for="main_position" class="form-label">Jabatan Utama:</label>
                        <input type="text" id="main_position" name="main_position" value="{{ $user->main_position }}"
                            class="form-control" required>
                    </div>

                    <!-- Additional Position -->
                    <div class="mb-3">
                        <label for="additional_position" class="form-label">Jabatan Tambahan:</label>
                        <input type="text" id="additional_position" name="additional_position"
                            value="{{ $user->additional_position }}" class="form-control">
                    </div>

                    <!-- Rank -->
                    <div class="mb-3">
                        <label for="rank" class="form-label">Pangkat:</label>
                        <input type="text" id="rank" name="rank" value="{{ $user->rank }}"
                            class="form-control">
                    </div>

                    <!-- Grade -->
                    <div class="mb-3">
                        <label for="grade" class="form-label">Golongan:</label>
                        <input type="text" id="grade" name="grade" value="{{ $user->grade }}"
                            class="form-control">
                    </div>

                    <!-- Job Tier -->
                    <div class="mb-3">
                        <label for="job_tier" class="form-label">Jenjang Jabatan:</label>
                        <input type="text" id="job_tier" name="job_tier" value="{{ $user->job_tier }}"
                            class="form-control">
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary me-2">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
