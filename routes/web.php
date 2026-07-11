<?php

use App\Http\Controllers\TypeController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::controller(FrontendController::class)->group(function () {
    Route::get('/home', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/store', 'store')->name('store');
    Route::get('/service', 'service')->name('service');
    Route::get('/contact', 'contact')->name('contact');
});

Route::middleware('auth')->group(function(){
    Route::get('master/cart',[CartController::class,'index'])->name('cart.index');
    Route::post('/cart/add',[CartController::class,'add'])->name('add.cart');
    Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::get('/clear-cart', function () {
    session()->forget('cart');
    return 'Cart berhasil dihapus';
    });

    // hewan saya
    Route::get('/user/hewan', [AnimalController::class, 'user_animal'])->name('user.animal');
    Route::get('/user/hewan/form', [AnimalController::class, 'userForm'])->name('user.animal.form');
    Route::post('/user/hewan/tambah', [AnimalController::class, 'tambah'])->name('user.animal.tambah');
    Route::get('/user/hewan/edit/{id}', [AnimalController::class, 'userEdit'])->name('user.animal.edit');
    Route::post('/user/hewan/update/{id}', [AnimalController::class, 'update'])->name('user.animal.update');
    Route::delete('/user/hewan/delete/{id}', [AnimalController::class, 'delete'])->name('user.animal.delete');

    // user profile
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');

    // order
    Route::get('order/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/proses', [OrderController::class, 'proses'])->name('order.proses');
    Route::get('/order/payment/{invoice}', [OrderController::class, 'payment'])->name('orders.payment');
    Route::get('/orders/{invoice}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::get('/service/reservasi/{id}', [FrontendController::class, 'reservasiForm'])->name('service.form');
    Route::post('/service/reservasi/{id}', [FrontendController::class, 'reservasiWa'])->name('service.wa');
    
    
        // Route::get('send-wa', function(){
        //     $response = http::withHeaders([
        //         'Authorization' => 'tuwQbcjYXTRCgskreGDT'
        //     ])->post('https://api.fonnte.com/send',[
        //         'target' => '085813524212',
        //         'message' => 'Hallo Apakah Ada Yang Bisa Saya Bantu?, apakah kamu mau reservasi?',
        //     ]);   
        // });

    Route::get('send-wa', function () {
        $pesan = urlencode("Halo, saya ingin berkonsultasi mengenai hewan peliharaan.");
        return redirect("https://wa.me/6285813524212?text={$pesan}");
    })->name('send-wa');
    
});

// midtrans callback
    Route::post('/midtrans/callback', [OrderController::class, 'callback'])
    ->name('midtrans.callback');
    Route::match(['get', 'post'], '/tes-callback', function (Request $request) {
        Log::info('TES CALLBACK');
        Log::info($request->all());
        return response()->json(['ok' => true]);
    });
    

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Admin
Route::middleware(['admin'])->group(function () {
    Route::get('master/user',[AuthController::class, 'index'])->name('user.index');
    Route::get('master/user/form/{id?}',[AuthController::class,'form'])->name('user.form');
    Route::post('master/user/add',[AuthController::class,'tambah'])->name('user.tambah');
    Route::post('master/user/update/{id}', [AuthController::class, 'update'])->name('user.update');
    Route::delete('master/user/delete/{id}', [AuthController::class, 'delete'])->name('user.delete');


    // Product
    Route::get('master/product', [ProductController::class,'index'])->name('product.index');
    Route::get('master/product/form/{id?}', [ProductController::class,'form'])->name('product.form');
    Route::post('master/product/add', [ProductController::class,'tambah'])->name('product.tambah');
    Route::post('master/product/update/{id?}', [ProductController::class,'update'])->name('product.update');
    Route::delete('master/product/delete/{id?}', [ProductController::class,'delete'])->name('product.delete');

    // Category
    Route::get('master/category',[CategoryController::class,'index'])->name('category.index');
    Route::get('master/category/form/{id?}',[CategoryController::class,'form'])->name('category.form');
    Route::post('master/category/add', [CategoryController::class,'tambah'])->name('category.tambah');
    // Route::get('master/category/form/{id?}',[CategoryController::class,'form'])->name('category.formupdate');
    Route::post('master/category/update/{id}', [CategoryController::class,'update'])->name('category.update');
    Route::delete('master/category/delete/{id}', [CategoryController::class,'delete'])->name('category.delete');

    // Animal
    Route::get('master/animal',[AnimalController::class,'index'])->name('animal.index');
    Route::get('master/animal/form/{id?}',[AnimalController::class,'form'])->name('animal.form');
    Route::post('master/animal/add', [AnimalController::class, 'tambah'])->name('animal.tambah');
    Route::post('master/animal/update/{id}', [AnimalController::class,'update'])->name('animal.update');
    Route::delete('master/animal/delete/{id}', [AnimalController::class,'delete'])->name('animal.delete');
    
    // Type
    Route::get('master/type/',[TypeController::class, 'index'])->name('type.index');
    Route::get('master/type/form/{id?}', [TypeController::class, 'form'])->name('type.form');
    Route::post('master/type/add', [TypeController::class, 'tambah'])->name('type.tambah');
    Route::post('master/type/update/{id}', [TypeController::class, 'update'])->name('type.update');
    Route::delete('master/type/delete/{id}', [TypeController::class, 'delete'])->name('type.delete');

    Route::get('master/karyawan/', [EmployeeController::class, 'index'])->name('karyawan.index');
    Route::get('master/karyawan/form/{id?}', [EmployeeController::class, 'form'])->name('karyawan.form');
    Route::post('master/karyawan/add', [EmployeeController::class, 'tambah'])->name('karyawan.tambah');
    Route::post('master/karyawan/update/{id}', [EmployeeController::class, 'update'])->name('karyawan.update');
    Route::delete('master/karyawan/delete/{id}', [EmployeeController::class, 'delete'])->name('karyawan.delete');

    // order
    Route::get('master/order', [OrderController::class, 'adminIndex'])->name('admin.order.index');
    Route::get('master/order/{id}', [OrderController::class,'adminShow'])->name('admin.order.show');
    Route::get('master/order/{id}/edit', [OrderController::class,'edit'])->name('admin.order.edit');
    Route::post('master/order/{id}/update', [OrderController::class,'update'])->name('admin.order.update');
    Route::delete('master/order/delete/{id}',[OrderController::class, 'delete'])->name('admin.order.delete');
    });

    Route::get('auth/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('auth/register', [AuthController::class, 'register'])->name('register');
    Route::get('auth/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('auth/logout', [AuthController::class,'logout'])->name('logout');

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->middleware('guest')->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors([
                'email' => [__($status)],
            ]);
    })->middleware('guest')->name('password.store');