<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <i class="fas fa-user-shield"></i> Admin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- Mobile Menu (visible only on mobile) -->
            <ul class="navbar-nav me-auto d-lg-none">
                <li class="nav-item">
                    <h6 class="navbar-text text-white-50 mt-2 mb-1 px-3">HOME</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">
                        <i class="fas fa-info-circle"></i> About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/dashboardadmin">
                        <i class="fas fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <h6 class="navbar-text text-white-50 mt-3 mb-1 px-3">ADMIN</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users">
                        <i class="fas fa-users"></i> Data Guru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/classes">
                        <i class="fas fa-school"></i> Kelas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/schedules">
                        <i class="fas fa-calendar-alt"></i> Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/absences">
                        <i class="fas fa-clipboard-check"></i> Laporan Kehadiran
                    </a>
                </li>
                <li class="nav-item">
                    <hr class="dropdown-divider bg-secondary">
                </li>
            </ul>

            <!-- Logout Button (always visible) -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="btn btn-danger btn-sm text-white" href="{{ route('auth.logout') }}">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
