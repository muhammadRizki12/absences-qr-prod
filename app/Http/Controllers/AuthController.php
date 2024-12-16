<?php

namespace App\Http\Controllers;

use App\Models\AbsenceModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // register
    // show register form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // procces register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required|in:male,female',
            'password' => 'required|min:6|confirmed',
        ]);

        // Registrasi hanya untuk role guru
        $user = UserModel::create([
            'username' => $request->username,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
            'role' => 'guru', // Set role guru untuk pengguna ini
        ]);

        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil. Silakan login!');
    }

    // show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // procces login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Jika admin login
            if ($user->role === 'admin') {
                return redirect()->route('dashboardadmin');
            }

            // Jika guru login
            if ($user->role === 'guru') {
                return redirect()->route('dashboardGuru.index');
            }
        }

        return back()->withErrors(['msg' => 'Username atau Password salah']);
    }

    // Halaman Dashboard
    public function dashboardadmin()
    {


        $users = UserModel::where('role', 'guru')->get();
        $usersCount = $users->count();

        // Mendapatkan tanggal sekarang
        $currentDate = Carbon::now()->toDateString(); // Format: "YYYY-MM-DD"

        // Query untuk memfilter berdasarkan tanggal (tanpa waktu)
        $absencePresent = AbsenceModel::where('status', 'Hadir')
            ->whereDate('absence_datetime', $currentDate)
            ->get();
        $absencePresentCount = $absencePresent->count();

        $absenceLate = AbsenceModel::where('status', 'Terlambat')
            ->whereDate('absence_datetime', $currentDate)
            ->get();
        $absenceLateCount = $absenceLate->count();

        $absenceAbsent = AbsenceModel::where('status', 'Tidak hadir')
            ->whereDate('absence_datetime', $currentDate)
            ->get();
        $absenceAbsentCount = $absenceAbsent->count();

        $absencePermission = AbsenceModel::where('status', 'Izin')
            ->whereDate('absence_datetime', $currentDate)
            ->get();
        $absencePermissionCount = $absencePermission->count();

        $data = [
            'total_guru' => $usersCount,
            'hadir' => $absencePresentCount,
            'terlambat' => $absenceLateCount,
            'tidak_hadir' => $absenceAbsentCount,
            'izin' => $absencePermissionCount,
        ];
        return view('dashboard/dashboardadmin', compact('data'));
    }

    public function dashboardguru()
    {
        return view('dashboard.dashboardguru');
    }

    public function about()
    {
        return view('about');
    }

    public function dataguru()
    {
        return view('dataguru');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.loginForm');
    }
}
