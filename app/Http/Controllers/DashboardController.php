<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardGuru()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('auth.login')->with('msg', 'Login terlebih dahulu!');

        return view('dashboard.dashboardGuru', compact('user'));
    }

    public function dashboardGuruEdit()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('auth.login')->with('msg', 'Login terlebih dahulu!');

        return view('dashboard.dashboardguruEdit', compact('user'));
    }

    public function dashboardGuruUpdate(Request $request)
    {
        // get id in session
        $id = Auth::user()->id;
        if (!$id) return redirect()->route('auth.login')->with('msg', 'Login terlebih dahulu!');

        // get user by id
        $user = UserModel::findOrFail($id);

        // Update password only if a new password is provided
        $data = $request->except(['password']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // update data
        $updateUser = $user->update($data);

        if (!$updateUser) return redirect()->route('dashboardGuru.edit')->with('msg', 'user update failed!');

        return redirect()->route('dashboardGuru.index')->with('msg', 'User updated successfully.');
    }
}
