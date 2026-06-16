@extends('layouts.app')

@section('content')
    <h1>{{ $site->name }}</h1>

    <p>Localisation : {{ $site->location ?? '-' }}</p>

    <a class="btn" href="{{ route('sites.index') }}">← Retour</a>

    <br><br>

    <h2>Utilisateurs assignés à ce site</h2>

    @if($site->users->isEmpty())
        <p>Aucun utilisateur assigné.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                </tr>
            </thead>
            <tbody>
                @foreach($site->users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
