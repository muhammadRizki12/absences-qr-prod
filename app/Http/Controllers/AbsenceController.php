<?php

namespace App\Http\Controllers;

use App\Models\AbsenceModel;
use App\Models\ClassModel;
use App\Models\ScheduleModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    public function index(Request $request)
    {
        $query = AbsenceModel::query();

        // Filter by date
        if ($request->filled('date')) {
            $query->whereDate('absence_datetime', Carbon::parse($request->date));
        }

        // Filter by teacher name (assuming 'username' is the teacher's name in users table)
        if ($request->filled('teacher_name')) {
            $query->whereHas('schedule.user', function ($query) use ($request) {
                $query->where('username', 'like', '%' . $request->teacher_name . '%');
            });
        }

        // Filter by subject (mata pelajaran)
        if ($request->filled('subject')) {
            $query->whereHas('schedule', function ($query) use ($request) {
                $query->where('study', 'like', '%' . $request->subject . '%');
            });
        }

        // Filter by class
        if ($request->filled('class_name')) {
            $query->whereHas('schedule.class', function ($query) use ($request) {
                $query->where('class_name', 'like', '%' . $request->class_name . '%');
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $absences = $query->get()->map(function ($absence) {
            $absence->date = Carbon::parse($absence->absence_datetime)->translatedFormat('j F Y');
            $absence->time = Carbon::parse($absence->absence_datetime)->toTimeString();
            return $absence;
        });

        return view('absences.index', compact('absences'));
    }

    public function edit($id)
    {
        $absence = AbsenceModel::findOrFail($id);
        return view('absences.edit', compact('absence'));
    }

    public function update(Request $request, $id)
    {
        $absence = AbsenceModel::findOrFail($id);

        // Update password only if a new password is provided
        $data = $request->only(['absence_datetime', 'status']);

        // update data
        $updateAbsence = $absence->update($data);

        if (!$updateAbsence) return redirect()->route('absence.edit')->with('msg', 'Absence update failed!');

        return redirect()->route('absence.index')->with('msg', 'Absence updated successfully.');
    }

    public function userAbsence()
    {
        $user_id = Auth::user()->id;

        $absences = AbsenceModel::whereHas('schedule', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->with(['schedule.class', 'schedule.user'])->get();

        $absences = $absences->map(function ($absence) {
            $absence->date = Carbon::parse($absence->absence_datetime)->translatedFormat('j F Y');
            $absence->time = Carbon::parse($absence->absence_datetime)->toTimeString();
            return $absence;
        });

        return view('absences.userAbsence', compact('absences'));
    }


    public function absence(Request $request)
    {
        // get user data by auth
        $user = Auth::user();

        // check authentication login
        if (!$user) return redirect()->route('auth.loginForm')->with('failed', 'Login terlebih dahulu!');

        // get id
        $user_id = $user->id;

        // get params class name
        $class_name = $request->class_name;

        return view('absences.absence', compact('class_name'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'class_name' => 'required'
        ]);

        $class_name = $request->class_name;

        // Ambil data koordinat kelas berdasarkan nama kelas
        $class = ClassModel::where('class_name', $class_name)->first();

        // Validasi jika kelas tidak ditemukan
        if (!$class) {
            return response()->json([
                'message' => 'Class not found.',
                'redirect_url' => '/users/absences/scan-qr',
            ], 400);
        }

        // Variabel lokasi saat ini (dari request pengguna)
        $latitudeCurrent = $request->latitude;
        $longitudeCurrent = $request->longitude;

        // Koordinat lokasi kelas (dari database)
        $longitudeClass = floatval($class->longitude);
        $latitudeClass = floatval($class->latitude);

        // Fungsi untuk menghitung jarak
        $distance = $this->distance($latitudeClass, $longitudeClass, $latitudeCurrent, $longitudeCurrent);

        if ($distance >= 5) {
            return response()->json([
                'message' => 'Anda di luar jangkauan!',
                'redirect_url' => '/users/absences/scan-qr',
            ], 400);
        }

        // get timeDate now
        $currentTime = Carbon::now();
        // set locale to indonesian
        Carbon::setLocale('id');

        // get day in locale indonesian
        $currentDay = $currentTime->translatedFormat('l');

        // get user data by auth
        $user_id = Auth::user()->id;

        // get schedule by user_id, class_name, and $current day
        $schedule = ScheduleModel::with('class')
            ->where('user_id', $user_id)
            ->whereHas('class', function ($query) use ($class_name) {
                $query->where('class_name', "$class_name");
            })
            ->where('day', $currentDay)
            ->first();

        // Validasi jika schedule gagal
        if (!$schedule) {
            return response()->json([
                'message' => 'Schedule failed!',
                'redirect_url' => '/users/absences/scan-qr',
            ], 400);
        }

        // cek schedule apakah sudah absen atau belum user-nya
        // absen hanya bisa 1x untuk 1 schedule
        $checkAbsence = AbsenceModel::where('schedule_id', $schedule->id)->get();
        $checkAbsenceCount = $checkAbsence->count();

        if ($checkAbsenceCount > 1) {
            return response()->json([
                'message' => 'Sudah absen!',
                'redirect_url' => '/users/absences',
            ], 400);
        }

        // Parsing entry time dan out time
        $entryTime = Carbon::parse($schedule->entry_time);
        $outTime = Carbon::parse($schedule->out_time);

        // added 30 minutes tolerance
        $entryTimePlus30 = $entryTime->copy()->addMinutes(30);

        // declaration status result
        $status = '';

        // validation absence time
        if ($currentTime->lt($entryTime)) {
            // absent before time
            return "Belum waktunya absen";
        } else if ($currentTime->between($entryTime, $entryTimePlus30)) {
            // ontime (30 minute after entry_time)
            $status = 'Hadir';
        } else if ($currentTime->gt($entryTimePlus30) && $currentTime->lt($outTime)) {
            // late (more than 30 minutes after entry time)
            $status = 'Terlambat';
        } else {
            // more than out time
            $status = 'Tidak hadir';
        }

        // saves data to absence
        $absence = AbsenceModel::create([
            'absence_datetime' => $currentTime,
            'status' => $status,
            'schedule_id' => $schedule->id
        ]);

        // Validasi jika schedule gagal
        if (!$absence) {
            return response()->json([
                'message' => 'Absence failed!',
                'redirect_url' => '/users/absences/scan-qr',
            ], 400);
        }

        // success response
        return response()->json([
            'message' => 'Absence Success!',
            'redirect_url' => '/users/absences',
        ], 200);
    }

    // scan
    public function scanQR()
    {
        return view('absences.scanQR');
    }

    // check distance
    public function checkDistance()
    {
        $latitude1 = -7.0361470;
        $longitude1 = 107.5354590;

        // location user
        $latitude2 = -7.009116810755372;
        $longitude2 = 107.55189327116385;

        $radius = $this->distance($latitude1, $longitude1, $latitude2, $longitude2);
        dd($radius);
    }

    // calculate distance
    public function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return $meters;
    }
}
