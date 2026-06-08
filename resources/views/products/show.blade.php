@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>

    <a class="btn" href="{{ route('products.index') }}">← Retour</a>
    <a class="btn" href="{{ route('products.edit', $product) }}">Modifier</a>

    <br><br>

    <table>
        <tr>
            <th>Référence</th>
            <td>{{ $product->reference }}</td>
        </tr>
        <tr>
            <th>Catégorie</th>
            <td>{{ $product->category?->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Quantité</th>
            <td>{{ $product->quantity }}</td>
        </tr>
        <tr>
            <th>Quantité minimum</th>
            <td>{{ $product->min_quantity }}</td>
        </tr>
        <tr>
            <th>Prix</th>
            <td>{{ $product->price }} DT</td>
        </tr>
        <tr>
            <th>Alerte</th>
            <td>
                @if($product->quantity <= $product->min_quantity)
                    ⚠️ Stock faible
                @else
                    ✅ OK
                @endif
            </td>
        </tr>
    </table>

    <br>

    <h2>Historique des mouvements</h2>

    @if($product->movements->isEmpty())
        <p>Aucun mouvement enregistré.</p>
    @else
        <table style="width:100%; border-collapse: collapse; text-align: center;">
    <thead>
        <tr>
            <th style="text-align: center;">Date</th>
            <th style="text-align: center;">Type</th>
            <th style="text-align: center;">Quantité</th>
            <th style="text-align: center;">Note</th>
        </tr>
    </thead>
    <tbody>
        @foreach($product->movements as $movement)
            <tr>
                <td style="text-align: center;">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                <td style="text-align: center;">{{ $movement->type }}</td>
                <td style="text-align: center;">{{ $movement->quantity }}</td>
                <td style="text-align: center;">{{ $movement->note ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
    @endif
@endsection

