<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('landingpage.home');
    }

    public function about()
    {
        return view('landingpage.about');
    }

    public function store(Request $request)
    {
        $search = $request->search;

        $products = Product::with('category')
        ->where('jenis', 'store')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_product', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($cat) use ($search) {
                      $cat->where('name', 'like', "%{$search}%");
                  });
            });
        })
        ->get();

    return view('landingpage.store', compact('products'));
    }

    public function service()
    {
        $data_grooming = Product::where('jenis', 'grooming')->get();
        $data_medical = Product::where('jenis', 'medical')->get();
        $data_hotel = Product::where('jenis', 'hotel')->get();

        return view('landingpage.service', compact(
            'data_grooming',
            'data_medical',
            'data_hotel'
        ));
    }

    public function reservasiForm($id)
    {
        $product = Product::findOrFail($id);
        $animals = Animal::where('user_id', Auth::id())->get();

        return view('user.reservasi', compact(
            'product',
            'animals'
        ));
    }

    public function reservasiWa(Request $request, $id)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id'
        ]);

        $product = Product::findOrFail($id);
        $animal = Animal::with('type')->findOrFail($request->animal_id);
        $user = Auth::user();

        $pesan = "Halo Admin PetShop,\n\n";
        $pesan .= "Saya ingin reservasi {$product->nama_product}.\n\n";
        $pesan .= "Nama Pemilik : {$user->name}\n";
        $pesan .= "Nama Hewan : {$animal->name}\n";
        $pesan .= "Jenis Hewan : {$animal->type->name}\n";
        $pesan .= "Jenis Hewan : {$animal->jenis_kelamin}\n";
        $pesan .= "Alamat : {$user->alamat}\n\n";
        $pesan .= "Mohon informasi jadwal yang tersedia.\n\n";
        $pesan .= "Terima kasih.";

        return redirect(
            "https://wa.me/6285813524212?text=" . urlencode($pesan)
        );
    }

    public function contact()
    {
        return view('landingpage.contact');
    }
}
