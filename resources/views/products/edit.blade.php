@extends('layouts.app')

@section('content')
    <h1>Modifier produit</h1>

    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Catégorie</label><br>
            <select name="category_id">
                <option value="">-- Sans catégorie --</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Nom produit</label><br>
            <input type="text" name="name" value="{{ old('name', $product->name) }}">

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Référence</label><br>
            <input type="text" name="reference" value="{{ old('reference', $product->reference) }}">

            @error('reference')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Quantité initiale</label><br>
            <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}">

            @error('quantity')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Quantité minimum</label><br>
            <input type="number" name="min_quantity" value="{{ old('min_quantity', $product->min_quantity) }}">

            @error('min_quantity')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Prix</label><br>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}">

            @error('price')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <button class="btn" type="submit">Enregistrer</button>
    </form>
@endsection
