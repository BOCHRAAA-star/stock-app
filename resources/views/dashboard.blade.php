@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>

    <div style="display:flex; gap:20px; margin-bottom:20px;">
        <div style="background:#0d6efd; color:white; padding:20px; border-radius:8px; flex:1; text-align:center;">
            <h3>{{ $productsCount }}</h3>
            <p>Produits</p>
        </div>
        <div style="background:#dc3545; color:white; padding:20px; border-radius:8px; flex:1; text-align:center;">
            <h3>{{ $lowStockCount }}</h3>
            <p>Stock Faible</p>
        </div>
        <div style="background:#198754; color:white; padding:20px; border-radius:8px; flex:1; text-align:center;">
            <h3>{{ $movementsCount }}</h3>
            <p>Mouvements</p>
        </div>
    </div>

    @if($lowStockProducts->count())
        <h3 style="color:#dc3545;">⚠ Produits en stock faible</h3>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Minimum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lowStockProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td style="color:#dc3545;">{{ $product->quantity }}</td>
                    <td>{{ $product->min_quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color:#198754;">✅ Tous les produits ont un stock suffisant!</p>
    @endif
@endsection
