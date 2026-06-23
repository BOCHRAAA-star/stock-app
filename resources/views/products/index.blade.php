@extends('layouts.app')

@section('content')
<div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="margin: 0; font-size: 1.75rem; color: #333;">Produits</h1>

        @if(auth()->user()->role === 'super-admin' )
            <a class="btn" href="{{ route('products.create') }}" style="background: #0d6efd; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 0.9rem;">
                + Ajouter produit
            </a>
        @endif
    </div>

    <form method="GET" action="{{ route('products.index') }}" style="display: flex; gap: 10px; margin-bottom: 24px;">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Recherche produit..."
            style="flex: 1; max-width: 400px; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 6px;"
        >
        <button class="btn" type="submit" style="background: #212529; color: white; padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer;">
            Rechercher
        </button>
    </form>

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #dee2e6; color: #6c757d;">
                <th style="padding: 12px;">Référence</th>
                <th style="padding: 12px;">Nom</th>
                <th style="padding: 12px;">Catégorie</th>
                <th style="padding: 12px;">Quantité</th>
                <th style="padding: 12px;">Prix</th>
                <th style="padding: 12px;">Alerte</th>
                <th style="padding: 12px; text-align: right;">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $product)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px; font-weight: 500;">{{ $product->reference }}</td>
                    <td style="padding: 12px;">{{ $product->name }}</td>
                    <td style="padding: 12px; color: #6c757d;">{{ $product->category?->name ?? '-' }}</td>
                    <td style="padding: 12px;">{{ $product->quantity }}</td>
                    <td style="padding: 12px; font-weight: 500;">{{ $product->price }} DT</td>
                    <td style="padding: 12px;">
                        @if($product->quantity <= $product->min_quantity)
                            <span style="background: #f8d7da; color: #842029; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">
                                Stock faible
                            </span>
                        @else
                            <span style="background: #d1e7dd; color: #0f5132; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem;">
                                OK
                            </span>
                        @endif
                    </td>
                    <td style="padding: 12px; text-align: right;">
                        <a href="{{ route('products.show', $product) }}" style="color: #0d6efd; text-decoration: none; margin-right: 8px;">Voir</a>

                        @if(auth()->user()->role === 'admin')
                            <span style="color: #ced4da;">|</span>
                            <a href="{{ route('products.edit', $product) }}" style="color: #ffc107; text-decoration: none; margin-left: 8px; margin-right: 8px;">Modifier</a>
                            <span style="color: #ced4da;">|</span>

                            <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline; margin-left: 8px;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Supprimer ce produit ?')" class="btn btn-danger" style="background: none; border: none; color: #dc3545; cursor: pointer; padding: 0; font-family: inherit; font-size: inherit;">
                                    Supprimer
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
</div>
@endsection
