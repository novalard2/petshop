<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('user.user_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'no_hp' => 'required|regex:/^[0-9]+$/|min:10|max:15',
            'alamat' => 'required',
        ]);

        Auth::user()->update($validate);
        return redirect()->route('home')
            ->with('success', 'Profile berhasil diperbarui.');
    }
}
