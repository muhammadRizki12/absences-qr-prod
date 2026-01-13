@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@push('styles')
    <style>
        .bg-db {
            background-image: url('{{ asset('assets/image/bgdb.jpg') }}');
            background-size: cover;
            background-position: center;
            min-height: 100%;
        }
    </style>
@endpush

@section('content')
    <div class="bg-db p-4">
        <h3>Dashboard</h3>
        <p>Data Hari ini</p>
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Guru</h5>
                        <p class="card-text">{{ $data['total_guru'] }} Guru</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Hadir</h5>
                        <p class="card-text">{{ $data['hadir'] }} Guru</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Terlambat</h5>
                        <p class="card-text">{{ $data['terlambat'] }} Guru</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Izin</h5>
                        <p class="card-text">{{ $data['izin'] }} Guru</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Tidak hadir</h5>
                        <p class="card-text">{{ $data['tidak_hadir'] }} Guru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
