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
        // Start building the query with product and site relationships
        $query = StockMovement::with(['product', 'site'])->latest();

        // If the logged-in user is NOT an admin or super_admin, restrict to their own movements
        if (auth()->user()->role === 'user') {
            $query->where('user_name', auth()->user()->name);
        }

        // If the user is a regular admin (not super_admin), restrict to their own site
        if (auth()->user()->role === 'admin') {
            $query->where('site_id', auth()->user()->site_id);
        }

        $movements = $query->paginate(15);

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

        // Automatically assign the logged-in user's name AND site
        $data['user_name'] = auth()->user()->name;
        $data['site_id']   = auth()->user()->site_id;

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
