<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.Login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }
                return redirect()->route('home');
        }
        return back()->withErrors([
            'email' => 'Email atau password salah'
        ]);
    }

    public function index()
        {
            $data = User::all();
            return view('pages/dashboard/master_users/index', compact('data'));
        }

    public function form($id = null){
        if($id){
            $data=User::where('id', $id)->first();
        }else{
            $data = null;
        }
        // dd($data);
        $roles = ['admin', 'user'];
        return view('pages/dashboard/master_users/form', compact('data', 'roles'));
        }
    public function tambah(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('user.index');
    }

    public function logout(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('home');
    }

    // Auth Register
    public function showRegister()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function update($id, Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        $user = User::findOrFail($id);
        $validate['password'] = Hash::make($validate['password']);
        $user->update($validate);
        return redirect()->route('user.index');
    }

    public function delete($id, Request $request){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }
    
}
