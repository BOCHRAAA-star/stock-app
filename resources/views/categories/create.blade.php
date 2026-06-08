@extends('layouts.app')

@section('content')
    <h2>Ajouter une catégorie</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div style="margin-bottom:15px;">
            <label>Nom</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn">Enregistrer</button>
        <a href="{{ route('categories.index') }}" class="btn btn-danger">Annuler</a>
    </form>
@endsection
