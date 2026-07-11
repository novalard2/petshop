<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Animal;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role','user')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalAnimals = Animal::count();

        return view('pages.dashboard.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalAnimals'
        ));
    }
}