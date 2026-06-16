<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Product::with('category')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('reference', 'like', "%{$search}%");
            })
            ->latest();

        // Super admin sees all products. Everyone else sees only their site's products.
        if (!auth()->user()->isSuperAdmin()) {
            $query->where('site_id', auth()->user()->site_id);
        }

        $products = $query->paginate(10);

        return view('products.index', compact('products', 'search'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'  => ['nullable', 'exists:categories,id'],
            'name'         => ['required', 'string', 'max:255'],
            'reference'    => ['required', 'string', 'max:100', 'unique:products,reference'],
            'quantity'     => ['required', 'integer', 'min:0'],
            'min_quantity' => ['required', 'integer', 'min:0'],
            'price'        => ['required', 'numeric', 'min:0'],
        ]);

        // Automatically assign the product to the logged-in user's site
        $data['site_id'] = auth()->user()->site_id;

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit ajouté avec succès.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'movements']);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id'  => ['nullable', 'exists:categories,id'],
            'name'         => ['required', 'string', 'max:255'],
            'reference'    => ['required', 'string', 'max:100', 'unique:products,reference,' . $product->id],
            'quantity'     => ['required', 'integer', 'min:0'],
            'min_quantity' => ['required', 'integer', 'min:0'],
            'price'        => ['required', 'numeric', 'min:0'],
        ]);

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}
