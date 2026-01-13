@extends('layouts.admin')

@section('title', 'Edit Kelas')

@section('content')

    <div class="container col-md-10 mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Update Nama Kelas</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('class.update', $class->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- NIP -->
                    <div class="mb-3">
                        <label for="class_name" class="form-label">Nama Kelas:</label>
                        <input type="text" id="class_name" name="class_name" value="{{ $class->class_name }}"
                            class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label d-block">Lokasi Kelas</label>
                            <button type="button" class="btn btn-outline-success btn-sm mb-3" onclick="getLocation()">
                                <i class="bi bi-geo-alt"></i> Ambil Lokasi Saat Ini
                            </button>
                            <small id="locationStatus" class="text-muted d-block mb-2"></small>
                        </div>


                        <div class="col-md mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder=".12345"
                                required>
                        </div>
                        <div class="col-md mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude"
                                placeholder="106.12345" required>
                        </div>

                    </div>


                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
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
