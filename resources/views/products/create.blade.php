@extends('layouts.app')

@section('content')
    <h1>Ajouter produit</h1>

    <form method="POST" action="{{ route('products.store') }}">
        @csrf

        <div>
            <label>Catégorie</label><br>
            <select name="category_id">
                <option value="">-- Sans catégorie --</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
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
            <input type="text" name="name" value="{{ old('name') }}">

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Référence</label><br>
            <input type="text" name="reference" value="{{ old('reference') }}">

            @error('reference')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Quantité initiale</label><br>
            <input type="number" name="quantity" value="{{ old('quantity', 0) }}">

            @error('quantity')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Quantité minimum</label><br>
            <input type="number" name="min_quantity" value="{{ old('min_quantity', 5) }}">

            @error('min_quantity')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Prix</label><br>
            <input type="number" step="0.01" name="price" value="{{ old('price', 0) }}">

            @error('price')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <button class="btn" type="submit">Enregistrer</button>
    </form>
@endsection