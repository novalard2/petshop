<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){

        $data = Employee::all();
        return view('pages/dashboard/master_karyawan/index', compact('data'));
    }

    public function form($id = null){
        if($id != null){
            $data = Employee::where('id', $id)->first();
        }else{
            $data =  null;
        }
        return view('pages.dashboard.master_karyawan.form', compact('data'));
    }

    public function tambah(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jabatan' => 'required'
        ]);

        // dd($validate);
        Employee::create($validate);
        return redirect()->route('karyawan.index');
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $id,
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'jabatan' => 'required'
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validate);
        return redirect()->route('karyawan.index');
    }

    public function delete($id, Request $request){
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('karyawan.index');
    }
}
