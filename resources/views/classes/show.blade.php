@extends('layouts.admin')

@section('title', 'Detail Kelas')

@section('content')

    <div class="container text-center col-md-6">
        <h3 class="mb-4">Detail Kelas</h3>
        <h5>Kelas {{ $class->class_name }}</h5>
        <div class="qr-code mb-3">
            {{ $qrCode }}
        </div>
        <a href="{{ route('class.downloadQrCode', $class->class_name) }}" class="btn btn-primary">
            Download QR Code
        </a>
    </div>

@endsection
