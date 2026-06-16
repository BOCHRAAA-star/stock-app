@extends('layouts.app')

@section('content')
    <h1>Sites (Usines)</h1>

    <a class="btn" href="{{ route('sites.create') }}">Ajouter un site</a>

    <br><br>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Localisation</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sites as $site)
                <tr>
                    <td>{{ $site->name }}</td>
                    <td>{{ $site->location ?? '-' }}</td>
                    <td>
                        <a href="{{ route('sites.show', $site) }}">Voir</a>
                        |
                        <a href="{{ route('sites.edit', $site) }}">Modifier</a>
                        |
                        <form action="{{ route('sites.destroy', $site) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Supprimer ce site ?')" class="btn btn-danger">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
