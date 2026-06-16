<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
{
    $productsCount = \App\Models\Product::count();

    // Calculate low stock items based on your threshold logic
    $lowStockProducts = \App\Models\Product::whereRaw('quantity <= min_quantity')->get();
    $lowStockCount = $lowStockProducts->count();

    // Context-filtered movement counter
    if (auth()->user()->role === 'admin') {
        $movementsCount = \App\Models\StockMovement::count();
    } else {
        $movementsCount = \App\Models\StockMovement::where('user_name', auth()->user()->name)->count();
    }

    return view('dashboard', compact('productsCount', 'lowStockCount', 'movementsCount', 'lowStockProducts'));
}
}
