<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
{
    $productsCount   = Product::count();
    $lowStockCount   = Product::whereColumn('quantity', '<=', 'min_quantity')->count();
    $movementsCount  = StockMovement::count();
    $lowStockProducts = Product::whereColumn('quantity', '<=', 'min_quantity')->latest()->take(5)->get();

    if (auth()->user()->isAdmin()) {
        return view('dashboard', compact('productsCount', 'lowStockCount', 'movementsCount', 'lowStockProducts'));
    }

    return view('dashboard-user', compact('productsCount', 'lowStockCount', 'movementsCount'));
}
}
