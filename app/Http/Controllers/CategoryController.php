<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::get();
        return view('pages/dashboard/master_category/index', compact('data'));
    }

    public function form($id = null){
        if ($id){
            // select * from category where id=xx
            $data=Category::where('id', $id)->first();
        }else{
            $data=null;
        }
        // dd($data);
        return view('pages.dashboard.master_category.form', compact('data'));
    }

    public function tambah(Request $request){
        $validate = $request->validate([
            'name'=> 'required',
        ]);

        // dd($validate);
        // insert into category (name) value (name)

        Category::create($validate);
        return redirect()->route('category.index');
    }

    public function update($id, Request $request){
        $validate = $request->validate([
            'name'=> 'required',
        ]);
        // dd($validate);

        // update  category set name=name where id=xx
        // Category::where('id', $request->id)->update($validate);
        $category = Category::findOrFail($id);
        $category->update($validate);
        return redirect()->route('category.index');
    }

    public function delete($id, Request $request){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index');
    }
}
