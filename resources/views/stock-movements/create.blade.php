@extends('layouts.app')

@section('content')
    <h1>Nouveau mouvement de stock</h1>

    <form method="POST" action="{{ route('stock-movements.store') }}">
        @csrf

        <div>
            <label>Produit</label><br>
            <select name="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} — Stock actuel : {{ $product->quantity }}
                    </option>
                @endforeach
            </select>

            @error('product_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Type</label><br>
            <select name="type">
                <option value="in">Entrée stock</option>
                <option value="out">Sortie stock</option>
            </select>

            @error('type')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Quantité</label><br>
            <input type="number" name="quantity" value="{{ old('quantity', 1) }}">

            @error('quantity')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Note</label><br>
            <input type="text" name="note" value="{{ old('note') }}">

            @error('note')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <button class="btn" type="submit">Valider mouvement</button>
    </form>
@endsection