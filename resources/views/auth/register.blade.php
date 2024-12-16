<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
        /* Gambar latar belakang full-screen */
        body {
            background-image: url('{{ asset('assets/image/bg1.jpg') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        /* Agar konten di tengah layar */
        .container {
            height: 100%;
        }

        /* Mengatur layout elemen secara vertikal dan horizontal */
        .row {
            height: 100%;
        }

        /* Responsif: Ubah ukuran form pada layar kecil */
        @media (max-width: 576px) {
            .col-md-4 {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-4 col-sm-8 col-10">
                <div class="bg-primary text-white rounded-4 p-4">
                    <h5 class="text-center">Create Account</h5>

                    <!-- Menampilkan error validasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('auth.register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="username" name="username" required
                                placeholder="Enter your username">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="male">Laki - Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="female">Perempuan</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required placeholder="Confirm your password">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-light">Register</button>
                        </div>
                    </form>

                    <p class="text-center mt-3"><small><a href="{{ route('auth.loginForm') }}"
                                class="text-light">Already have an
                                account? Login here</a></small></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
