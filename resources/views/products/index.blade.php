
@extends('layouts.app')

@section('content')
    <h1>Produits</h1>

    <form method="GET" action="{{ route('products.index') }}">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Recherche produit..."
        >

        <button class="btn" type="submit">Rechercher</button>
    </form>

    <br>

    <a class="btn" href="{{ route('products.create') }}">Ajouter produit</a>

    <br><br>

    <table>
        <thead>
            <tr>
                <th>Référence</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Alerte</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->reference }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category?->name ?? '-' }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->price }} DT</td>

                    <td>
                        @if($product->quantity <= $product->min_quantity)
                            Stock faible
                        @else
                            OK
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('products.show', $product) }}">Voir</a>
                        |
                        <a href="{{ route('products.edit', $product) }}">Modifier</a>
                        |
                        <form
                            action="{{ route('products.destroy', $product) }}"
                            method="POST"
                            style="display:inline;"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Supprimer ce produit ?')"
                                class="btn btn-danger"
                            >
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
@endsection
