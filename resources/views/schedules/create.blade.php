@extends('layouts.admin')

@section('title', 'Buat Jadwal')

@section('content')

    <div class="container col-md-10">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Buat Jadwal</h4>
            </div>

            <div class="mt-3">
                <x-alert />
            </div>

            <div class="card-body">
                <form action="{{ route('schedule.store') }}" method="post">
                    @csrf

                    <!-- Study -->
                    <div class="mb-3">
                        <label for="study" class="form-label">Mata pelajaran</label>
                        <input type="text" name="study" id="study" class="form-control" required>
                    </div>

                    <!-- User Selection -->
                    <div class="mb-3">
                        <label for="users" class="form-label">Choose a User</label>
                        <select name="user_id" id="users" class="form-select" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Class Selection -->
                    <div class="mb-3">
                        <label for="classes" class="form-label">Choose a Class</label>
                        <select name="class_id" id="classes" class="form-select" required>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Day Selection -->
                    <div class="mb-3">
                        <label for="day" class="form-label">Choose a Day</label>
                        <select name="day" id="day" class="form-select" required>
                            <option value="">--pilih hari--</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>

                    {{-- entry and out time --}}
                    <div class="row mb-3">
                        <!-- Entry Time -->
                        <div class="col-md-6">
                            <label for="entry_time" class="form-label">Entry Time</label>
                            <input type="time" name="entry_time" id="entry_time" class="form-control" required>
                        </div>

                        <!-- Out Time -->
                        <div class="col-md-6">
                            <label for="out_time" class="form-label">Out Time</label>
                            <input type="time" name="out_time" id="out_time" class="form-control" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
