<?php

namespace App\Http\Controllers;
use App\Models\Animal;
use App\Models\Type;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $data = Animal::with(['type', 'user'])->get();
        } else {
            $data = Animal::with(['type', 'user'])
            ->where('user_id', Auth::id())
            ->get();
        }
        return view('pages/dashboard/master_animal/index', compact('data'));
    }

    public function form($id = null)
    {
        if($id){
            $data = Animal::find($id);
        }else{
            $data=null;
        }
        $types = Type::all(); 
        $users = User::where('role', 'user')->get();
        return view('pages.dashboard.master_animal.form', [
            'data' => $data,
            'types' => $types,
            'users' => $users,
        ]);
    }

    public function tambah(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'tgl_lahir' => 'required',
            'type_id' => 'required|exists:types,id',
            'jenis_kelamin' => 'required',
        ]);
        if (Auth::user()->role == 'admin') {
            $validate['user_id'] = $request->user_id;
        } else {
            $validate['user_id'] = Auth::id();
        }
        Animal::create($validate);
        if (Auth::user()->role == 'admin') {
            return redirect()->route('animal.index')
                            ->with('success', 'Data hewan berhasil ditambahkan.');
        }
        return redirect()->route('user.animal')
                        ->with('success', 'Data hewan berhasil ditambahkan.');
    }

    public function update($id, Request $request)
    {    
        $validate = $request->validate([
            'name' => 'required',
            'tgl_lahir' => 'required',
            'type_id' => 'required|exists:types,id',
            'jenis_kelamin' => 'required',
        ]);

        if (Auth::user()->role == 'admin') {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $validate['user_id'] = $request->user_id;
        } else {
            $validate['user_id'] = Auth::id();
        }

        if (Auth::user()->role == 'admin') {
            $animal = Animal::findOrFail($id);
        } else {
            $animal = Animal::where('user_id', Auth::id())
                ->findOrFail($id);
        }
        
        $animal->update($validate);

        if (Auth::user()->role == 'admin') {
            return redirect()->route('animal.index')
                ->with('success', 'Data hewan berhasil diubah.');
        }
        return redirect()->route('user.animal')
            ->with('success', 'Data hewan berhasil diubah.');
    }

    public function delete($id, Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $animal = Animal::findOrFail($id);
        } else {
            $animal = Animal::where('user_id', Auth::id())
                ->findOrFail($id);
        }
        $animal->delete();

        if (Auth::user()->role == 'admin') {
            return redirect()->route('animal.index')
                ->with('success', 'Data hewan berhasil dihapus.');
        }

        return redirect()->route('user.animal')
            ->with('success', 'Data hewan berhasil dihapus.');
    }

    public function user_animal()
    {
      $data = Animal::with(['type', 'user'])
            ->where('user_id', Auth::id())
            ->get();
        return view('user.user_animal', compact('data'));
    }

    public function userForm()
    {
        $types = Type::all();
        $data = null;

        return view('user.user_form', compact('types', 'data'));
    }

    public function userEdit($id)
    {
        $data = Animal::where('user_id', Auth::id())
            ->findOrFail($id);
        $types = Type::all();

        return view('user.user_form', compact('data', 'types'));
    }
}

