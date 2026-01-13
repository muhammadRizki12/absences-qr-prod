@extends('layouts.guru')

@section('title', 'Scan QR Code Absensi Guru')

@section('content')

    <!-- Main Content -->
    <div class="container col-md-10 mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Scan QR Code Absensi Guru</h4>
                    </div>
                    <div class="card-body justify-content-center d-flex">
                        <!-- QR Code Scanner -->
                        <div style="width: 500px" id="reader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to start QR code scanning with camera
        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            window.location.href = decodedText;
            html5QrcodeScanner.clear();
        }

        function onScanError(errorMessage) {
            // handle on error condition, with error message
            console.log(`Error: ${errorMessage}`);
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 300
            });
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>

@endsection
