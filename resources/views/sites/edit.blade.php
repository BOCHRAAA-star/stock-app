@extends('layouts.app')

@section('content')
    <h1>Modifier le site</h1>

    <form method="POST" action="{{ route('sites.update', $site) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Nom du site</label><br>
            <input type="text" name="name" value="{{ old('name', $site->name) }}">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Localisation</label><br>
            <input type="text" name="location" value="{{ old('location', $site->location) }}">
            @error('location')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <button class="btn" type="submit">Enregistrer</button>
    </form>
@endsection
