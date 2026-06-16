@extends('layouts.app')

@section('content')
<div style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; font-size: 1.5rem; color: #333;">Gestion des Utilisateurs</h2>

        <a href="{{ route('users.create') }}" style="background: #0d6efd; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 0.9rem;">
            + Ajouter un Utilisateur
        </a>
    </div>

    @if(session('success'))
        <div style="background: #d1e7dd; color: #0f5132; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 2px solid #dee2e6; color: #6c757d;">
                <th style="padding: 12px;">Nom</th>
                <th style="padding: 12px;">Email</th>
                <th style="padding: 12px;">Rôle</th>
                <th style="padding: 12px;">Créé le</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr style="border-bottom: 1px solid #dee2e6;">
                <td style="padding: 12px; font-weight: 500;">{{ $user->name }}</td>
                <td style="padding: 12px; color: #6c757d;">{{ $user->email }}</td>
                <td style="padding: 12px;">
                    <span style="background: {{ $user->role === 'admin' ? '#f8d7da' : '#e2e3e5' }}; color: {{ $user->role === 'admin' ? '#842029' : '#41464b' }}; padding: 4px 8px; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">
                        {{ ucfirst($user->role) }}
                    </span>
                </td>
                <td style="padding: 12px; color: #6c757d;">{{ $user->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
</div>
@endsection
