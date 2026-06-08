<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with('product')
            ->latest()
            ->paginate(15);

        return view('stock-movements.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('stock-movements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'type'       => ['required', 'in:in,out'],
            'quantity'   => ['required', 'integer', 'min:1'],
            'note'       => ['nullable', 'string', 'max:255'],
        ]);

        $product = Product::findOrFail($data['product_id']);

        if ($data['type'] === 'out' && $product->quantity < $data['quantity']) {
            return back()
                ->withErrors(['quantity' => 'Stock insuffisant pour cette sortie.'])
                ->withInput();
        }

        DB::transaction(function () use ($product, $data) {
            StockMovement::create($data);

            if ($data['type'] === 'in') {
                $product->increment('quantity', $data['quantity']);
            } else {
                $product->decrement('quantity', $data['quantity']);
            }
        });

        return redirect()
            ->route('stock-movements.index')
            ->with('success', 'Mouvement de stock enregistré.');
    }
}