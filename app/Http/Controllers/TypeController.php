<?php

namespace App\Http\Controllers;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(){

        $data = Type::get();
        return view('pages/dashboard/master_type/index', compact('data'));
    }

    public function form($id = null){
        if ($id){

            $data=Type::where('id', $id)->first();
        }else{
            $data = null;
        }
        
        return view('pages.dashboard.master_type.form', compact('data'));
    }

    public function tambah(Request $request){
        $validate = $request->validate([
            'name' => 'required'
        ]);

        // dd($validate)

        Type::create($validate);
        return redirect()->route('type.index');
    }
    
    public function update($id, Request $request){
        $validate = $request->validate([
            'name' => 'required'
        ]);

        $type = Type::findOrFail($id);
        $type->update($validate);
        return redirect()->route('type.index');
    }

    public function delete($id, Request $request){
        $type = Type::findOrFail($id);
        $type->delete();
        return redirect()->route('type.index');
    }
}
