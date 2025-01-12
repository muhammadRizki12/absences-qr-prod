<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ScheduleModel;
use App\Models\UserModel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        // query builder untuk mendapatkan data schedule
        $query = ScheduleModel::query();

        // Filter by study
        if ($request->filled('study')) {
            $query->where('study', 'like', '%' . $request->study . '%');
        }

        // Filter by day
        if ($request->filled('day')) {
            $query->where('day', 'like', '%' . $request->day . '%');
        }

        // Filter by teacher name
        if ($request->filled('teacher_name')) {
            $query->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->teacher_name . '%');
            });
        }

        // Filter by class name
        if ($request->filled('class_name')) {
            $query->whereHas('class', function ($query) use ($request) {
                $query->where('class_name', 'like', '%' . $request->class_name . '%');
            });
        }

        // Get data schedule
        $schedules = $query->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $users = UserModel::where('role', 'guru')->get();
        $classes = ClassModel::all();
        return view('schedules.create', compact('users', 'classes'));
    }

    public function store(Request $request)
    {
        $schedule = ScheduleModel::create([
            'study' => $request->study,
            'day' => $request->day,
            'entry_time' => $request->entry_time,
            'out_time' => $request->out_time,
            'user_id' => $request->user_id,
            'class_id' => $request->class_id,
        ]);

        // if failed
        if (!$schedule) return redirect()->route('schedule.create')->with('msg', 'Schedule insert failed!');

        // Return data schedule sebagai respons JSON
        return redirect()->route('schedule.index')->with('msg', 'Schedule insert successfully.');
    }

    public function edit($id)
    {
        $schedule = ScheduleModel::findOrFail($id);
        $users = UserModel::where('role', 'guru')->get();
        $classes = ClassModel::all();
        return view('schedules.edit', compact('schedule', 'classes', 'users'));
    }

    public function update(Request $request, $id)
    {
        $schedule = ScheduleModel::findOrFail($id);

        $data = $request->all();

        // update data
        $updateSchedule = $schedule->update($data);

        if (!$updateSchedule) return redirect()->route('schedule.edit')->with('msg', 'Schedule update failed!');

        return redirect()->route('schedule.index')->with('msg', 'Schedule updated successfully.');
    }

    public function destroy($id)
    {
        $schedule = ScheduleModel::findOrFail($id);
        $deleteSchedule = $schedule->delete();

        if (!$deleteSchedule) return redirect()->route('schedule.index')->with('msg', 'Schedule delete failed!');

        return redirect()->route('schedule.index')->with('msg', 'Schedule deleted successfully.');
    }

    public function scheduleUser()
    {
        $user_id = Auth::user()->id;
        $schedules = ScheduleModel::where('user_id', $user_id)->get();

        return view('schedules.scheduleUser', compact('schedules'));
    }
}
