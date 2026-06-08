@extends('layouts.app')

@section('content')
    <h2>Modifier la catégorie</h2>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div style="margin-bottom:15px;">
            <label>Nom</label><br>
            <input type="text" name="name" value="{{ old('name', $category->name) }}">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn">Mettre à jour</button>
        <a href="{{ route('categories.index') }}" class="btn btn-danger">Annuler</a>
    </form>
@endsection
