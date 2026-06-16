@extends('layouts.app')

@section('content')
    <h1>Ajouter un site</h1>

    <form method="POST" action="{{ route('sites.store') }}">
        @csrf

        <div>
            <label>Nom du site</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div>
            <label>Localisation</label><br>
            <input type="text" name="location" value="{{ old('location') }}">
            @error('location')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <button class="btn" type="submit">Enregistrer</button>
    </form>
@endsection
