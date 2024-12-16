<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = UserModel::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = UserModel::create([
            'nip' => $request->nip,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'gender' => $request->gender,
            'rank' => $request->rank,
            'grade' => $request->grade,
            'job_tier' => $request->job_tier,
            'main_position' => $request->main_position,
            'additional_position' => $request->additional_position,
            'role' => 'guru',
        ]);

        // failed user add
        if (!$user) return redirect()->route('user.create')->with('msg', 'user insert failed!');

        // Redirect dengan pesan sukses
        return redirect()->route('user.index')->with('msg', 'User created successfully!');
    }

    public function show($id)
    {
        $user = UserModel::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        /* check hash
        dd(Hash::check('123456', '$2y$10$92ySwiotE9bHCZVZGbYX2..MlJ8e7EubcgJgzx2gtG4sD97FQJum.'));
        */

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);

        // Update password only if a new password is provided
        $data = $request->except(['password']);
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        // update data
        $updateUser = $user->update($data);

        if (!$updateUser) return redirect()->route('user.edit')->with('msg', 'user update failed!');

        return redirect()->route('user.index')->with('msg', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $deleteUser = $user->delete();

        if (!$deleteUser) return redirect()->route('user.index')->with('msg', 'user delete failed!');

        return redirect()->route('user.index')->with('msg', 'User deleted successfully.');
    }
}
