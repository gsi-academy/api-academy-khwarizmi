<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class AdminStatsController extends Controller
{
    public function getStats()
    {
        $now = Carbon::now();

        // 🔹 Total Revenue (paid only)
        $totalRevenue = Order::where('status', 'paid')
            ->sum('total_price');

        // 🔹 Sales This Month
        $salesThisMonth = Order::where('status', 'paid')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // 🔹 Revenue This Month
        $revenueThisMonth = Order::where('status', 'paid')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->sum('total_price');

        // 🔹 Revenue Last Month
        $revenueLastMonth = Order::where('status', 'paid')
            ->whereMonth('created_at', $now->copy()->subMonth()->month)
            ->whereYear('created_at', $now->copy()->subMonth()->year)
            ->sum('total_price');

        // 🔹 Revenue Growth %
        $revenueGrowth = 0;

        if ($revenueLastMonth > 0) {
            $revenueGrowth = (
                ($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth
            ) * 100;
        }

        // 🔹 Active Students
        $activeStudents = User::where('role', 'student')->count();

        // 🔹 Recent Transactions
        $recentTransactions = Order::with(['user:id,name', 'course:id,title'])
            ->where('status', 'paid')
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'total_revenue' => $totalRevenue,
            'sales_this_month' => $salesThisMonth,
            'active_students' => $activeStudents,
            'revenue_growth' => round($revenueGrowth, 1) . '%',
            'recent_transactions' => $recentTransactions,
        ]);
    }
}
