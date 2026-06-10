@extends('layouts.app')

@section('content')
    <h1>Tableau de bord</h1>

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
    <br>
    <a class="btn" href="{{ route('products.index') }}">Voir les produits</a>
    <a class="btn" href="{{ route('stock-movements.create') }}">Nouveau mouvement</a>
@endsection
