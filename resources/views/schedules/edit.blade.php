@extends('layouts.admin')

@section('title', 'Edit Jadwal')

@section('content')

    <div class="container col-md-10">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Edit Jadwal</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('schedule.update', $schedule->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <!-- Mata Pelajaran -->
                    <div class="mb-3">
                        <label for="study" class="form-label">Mata Pelajaran</label>
                        <input type="text" name="study" id="study" class="form-control"
                            value="{{ $schedule->study }}" required>
                    </div>

                    <!-- Pilih Guru -->
                    <div class="mb-3">
                        <label for="users" class="form-label">Pilih Guru</label>
                        <select name="user_id" id="users" class="form-select" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $schedule->user_id ? 'selected' : '' }}>
                                    {{ $user->username }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Kelas -->
                    <div class="mb-3">
                        <label for="classes" class="form-label">Pilih Kelas</label>
                        <select name="class_id" id="classes" class="form-select" required>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ $class->id == $schedule->class_id ? 'selected' : '' }}>
                                    {{ $class->class_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Hari -->
                    <div class="mb-3">
                        <label for="day" class="form-label">Pilih Hari</label>
                        <select name="day" id="day" class="form-select" required>
                            <option value="">--Pilih Hari--</option>
                            <option value="Senin" {{ $schedule->day == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ $schedule->day == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ $schedule->day == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ $schedule->day == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ $schedule->day == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        </select>
                    </div>

                    <!-- Jam Masuk -->
                    <div class="mb-3">
                        <label for="entry_time" class="form-label">Jam Masuk</label>
                        <input type="time" name="entry_time" id="entry_time" class="form-control"
                            value="{{ $schedule->entry_time }}" required>
                    </div>

                    <!-- Jam Keluar -->
                    <div class="mb-3">
                        <label for="out_time" class="form-label">Jam Keluar</label>
                        <input type="time" name="out_time" id="out_time" class="form-control"
                            value="{{ $schedule->out_time }}" required>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
