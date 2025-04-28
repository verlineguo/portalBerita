<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('admin.user.create');
    }

    public function manage(Request $request) {
        $query = User::query();

    if ($request->filled('role')) { // Cek kalau role tidak kosong
        $query->where('role', $request->role);
    }

    $users = $query->get();
        
        return view('admin.user.manage', compact('users'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|integer|max:4',
            'status' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => $request->status ? 1 : 0,
        ]);
        return redirect()->route('admin.user.manage')->with('success', 'User added successfully!');
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $validate_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|integer|max:4'

        ]);

        $user = User::findOrFail($id);
        $user->update($validate_data);

        return redirect()->route('admin.user.manage')->with('success', 'User updated successfully!');
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.manage')->with('success', 'User deleted successfully!');
    }
}
