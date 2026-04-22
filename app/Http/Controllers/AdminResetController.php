<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminResetController extends Controller
{
    /**
     * Show the reset form.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.reset', compact('users'));
    }

    /**
     * Reset username and password.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'new_username' => 'required|string|max:255|unique:users,username,' . $request->user_id,
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::find($request->user_id);
        $user->username = $request->new_username;
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.reset')
            ->with('success', 'Username dan password berhasil direset untuk user: ' . $user->username);
    }

    /**
     * Delete all users and allow new registration.
     */
    public function clearAll()
    {
        User::truncate();
        return redirect()->route('admin.reset')
            ->with('success', 'Semua user telah dihapus. Registrasi baru sekarang diperbolehkan.');
    }
}
