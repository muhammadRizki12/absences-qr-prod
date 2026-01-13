@extends('layouts.admin')

@section('title', 'Data Kelas')



@section('content')
    <div class="container col-md-10">
        <h3 class="mb-4">Kelas</h3>

        {{-- Alert Component - handles all message types --}}
        <x-alert />

        <div class="text-end mb-3">

            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClassModal">
                <i class="fas fa-plus"></i> Tambah Kelas
            </button>

        </div>

        <table class="table text-center table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kelas</th>
                    <th scope="col">Koordinat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $class->class_name }}</td>
                        <td>{{ $class->latitude }}, {{ $class->longitude }}</td>
                        <td>
                            <a href="{{ route('class.edit', $class->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('class.destroy', $class->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Are you sure you want to delete this class?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                            <a href="{{ route('class.downloadQrCode', $class->class_name) }}" class="btn btn-primary btn-sm"
                                title="Detail">
                                <i class="fas fa-download"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal add classes --}}
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('class.store') }}" method="POST">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addClassModalLabel">Tambah Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        @csrf
                        <div class="mb-3">
                            <label for="class_name" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="class_name" name="class_name"
                                placeholder="Masukkan nama kelas" required>
                        </div>

                        <div>
                            <label class="form-label d-block">Lokasi Kelas</label>
                            <button type="button" class="btn btn-outline-success btn-sm mb-3" onclick="getLocation()">
                                <i class="bi bi-geo-alt"></i> Ambil Lokasi Saat Ini
                            </button>
                            <small id="locationStatus" class="text-muted d-block mb-2"></small>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude"
                                        placeholder="-6.12345" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude"
                                        placeholder="106.12345" required>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        function getLocation() {
            const status = document.getElementById('locationStatus');
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            if (!navigator.geolocation) {
                status.textContent = "Browser Anda tidak mendukung fitur lokasi.";
                return;
            }

            status.textContent = "Sedang mengambil lokasi...";

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    latInput.value = lat;
                    lngInput.value = lng;
                    status.textContent = "Lokasi berhasil diperbarui!";
                    status.className = "text-success d-block mb-2";
                },
                (error) => {
                    status.className = "text-danger d-block mb-2";
                    switch (error.code) {
                        case error.PERMISSION_DENIED:
                            status.textContent = "Pengguna menolak permintaan lokasi.";
                            break;
                        case error.POSITION_UNAVAILABLE:
                            status.textContent = "Informasi lokasi tidak tersedia.";
                            break;
                        case error.TIMEOUT:
                            status.textContent = "Waktu permintaan lokasi habis.";
                            break;
                        default:
                            status.textContent = "Terjadi kesalahan yang tidak diketahui.";
                            break;
                    }
                }
            );
        }
    </script>
@endsection
