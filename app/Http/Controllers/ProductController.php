<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data= Product::with('Category')->get();
        return view('pages/dashboard/master_product/index', compact('data'));
    }

    public function form($id = null){
        if($id){
            $data=product::where('id', $id)->first();
        }else{
            $data=null;
        }
        $categories = Category::all();
        return view('pages.dashboard.master_product.form', compact('data', 'categories'));
    }

    public function tambah(Request $request){
    $validated = $request->validate([
        'nama_product'=> 'required',
        'category_id' => 'required|exists:categories,id',
        'harga'=> 'required',
        'description'=> 'required',
        'jenis'=> 'required',
        'foto'=> 'required|mimes:jpg,jpeg,png|max:2048',
    ]);
        $product = new Product();
        $product->category_id = $request->category_id;

        $product->nama_product = $request->nama_product;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->jenis = $request->jenis;
        $product->description = $request->description;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('product', $filename, 'public');
            $product->foto = $filename; // simpan nama file
        }
        $product->save();
        return redirect()->route('product.index');
    }
    
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'nama_product' => 'required',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required',
            'description' => 'required',
            'stok' => 'required',
            'jenis' => 'required',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('product', $filename, 'public');
            $validated['foto'] = $filename;
        }

        $product->update($validated);

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil diupdate');
    }

    public function delete($id, Request $request){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index');
    }

}
