<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center vh-100">
        <h5 id="status"></h5>
        <a href="{{ route('absence.scanQR') }}" id="btnBack" class="btn btn-danger" hidden>kembali</a>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const status = document.getElementById('status');
            const btnBack = document.getElementById('btnBack');

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async (position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);

                    // Prepare data to send
                    const data = {
                        _token: "{{ csrf_token() }}",
                        class_name: "{{ $class_name }}",
                        latitude,
                        longitude
                    };

                    try {
                        const response = await fetch('/users/absences/{{ $class_name }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
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
                            // console.error('Failed to send data:', response.statusText);
                            alert(data.message);
                        }
                    } catch (error) {
                        status.innerText = data.message;
                        btnBack.removeAttribute('hidden');
                        console.error('Error:', error);
                    }
                }, (error) => {
                    console.error('Error getting location:', error.message);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        });
    </script>
</body>

</html>
