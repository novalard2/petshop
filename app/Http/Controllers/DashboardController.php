<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalAnimals = Animal::count();

        // Order Status
        $paidOrders = Order::where('payment_status', 'paid')->count();
        $pendingOrders = Order::where('payment_status', 'pending')->count();
        $failedOrders = Order::where('payment_status', 'failed')->count();
        $expiredOrders = Order::where('payment_status', 'expired')->count();

        // income
        $weeklyIncome = Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->sum('total');

        $monthlyIncome = Order::where('payment_status', 'paid')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');

        $yearlyIncome = Order::where('payment_status', 'paid')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total');

        $monthlyRevenue = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total) as total')
        )
            ->where('payment_status', 'paid')
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        $revenueData = [];

        for ($i = 1; $i <= 12; $i++) {
            $revenueData[] = $monthlyRevenue[$i] ?? 0;
        }

        return view('pages.dashboard.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalAnimals',

            'paidOrders',
            'pendingOrders',
            'failedOrders',
            'expiredOrders',

            'weeklyIncome',
            'monthlyIncome',
            'yearlyIncome',

            'revenueData'
        ));
    }
}