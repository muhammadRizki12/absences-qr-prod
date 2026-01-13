@extends('layouts.admin')

@section('title', 'About')

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
    <div class="bg-db">
        <h3>Visi dan Misi</h3>
        <div class="card mb-4">
            <div class="card-header bg-success text-white text-center">
                <h5>VISI</h5>
            </div>
            <div class="card-body text-center">
                <p>Terwujudnya Peserta Didik Yang Religius, Cerdas, Terampil, Mandiri Dan Berwawasan
                    Global</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-success text-white text-center">
                <h5>MISI</h5>
            </div>
            <div class="card-body">
                <ul>
                    <li>Menanamkan keimanan dan ketakwaan, melalui pengalaman ajaran agama</li>
                    <li>Mengoptimalkan proses pembelajaran dan bimbingan</li>
                    <li>Mengembangkan bidang ilmu pengetahuan dan teknologi berdasarkan minat bakat
                        dan potensi peserta didik</li>
                    <li>Membina kemandirian peserta didik melalui kegiatan pembiasaan,
                        kewirausahaan, dan pengembangan diri yang terencana dan berkesinambungan
                    </li>
                    <li>Menjalin kerjasama yang harmonis antar warga sekolah, dan lembaga lain yang
                        terkait</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
