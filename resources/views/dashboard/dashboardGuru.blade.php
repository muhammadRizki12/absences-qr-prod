@extends('layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Identitas Guru</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Nama Lengkap
                                <span class="badge bg-primary rounded-pill">{{ $user->username }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                NIP
                                <span class="badge bg-secondary rounded-pill">{{ $user->nip }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Jenis Kelamin
                                <span class="badge bg-warning rounded-pill">{{ $user->gender }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Jenjang Jabatan
                                <span class="badge bg-info rounded-pill">{{ $user->job_tier }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Pangkat
                                <span class="badge bg-info rounded-pill">{{ $user->rank }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Golongan
                                <span class="badge bg-info rounded-pill">{{ $user->grade }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Jabatan Tugas Utama
                                <span class="badge bg-danger rounded-pill">{{ $user->main_position }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Jabatan Tugas Tambahan
                                <span class="badge bg-danger rounded-pill">{{ $user->additional_position }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Email
                                <span class="badge bg-success rounded-pill">{{ $user->email }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ route('dashboardGuru.edit') }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
