@extends('layouts.guru')

@section('title', 'Absensi Kehadiran')

@section('content')

    <div class="d-flex flex-column justify-content-center align-items-center vh-100">
        <h5 id="status"></h5>
        <a href="{{ route('absence.scanQR') }}" id="btnBack" class="btn btn-secondary btn-sm" hidden>kembali</a>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const status = document.getElementById('status');
            const btnBack = document.getElementById('btnBack');

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);

                    // Prepare data to send
                    const data = {
                        latitude,
                        longitude
                    };

                    try {
                        const response = await fetch("/users/absences/{{ $class_name }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify(data)
                        });


                        if (response.ok) {
                            const data = await response.json();
                            // console.log('Response:', data);
                            window.location.href = data.redirect_url;
                            alert(data.message);
                        } else {
                            const data = await response.json();
                            status.innerText = data.message;
                            btnBack.removeAttribute('hidden');
                            window.location.href = data.redirect_url;
                            console.error('Failed to send data:', response.statusText);
                            alert(data.message);
                        }
                    } catch (error) {

                        status.innerText = error.message;
                        console.log(error.message);

                        btnBack.removeAttribute('hidden');
                        // console.error('Error:', error);
                    }
                }, (error) => {
                    console.error('Error getting location:', error.message);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        });
    </script>

@endsection
