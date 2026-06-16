@extends('layouts.app')

@section('content')
<div style="max-width: 600px; background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin: 0 auto;">
    <h2 style="margin-top: 0; margin-bottom: 20px; font-size: 1.5rem; color: #333;">Créer un Nouvel Utilisateur</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 16px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 500; color: #495057;">Nom complet</label>
            <input type="text" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box;">
            @error('name')
                <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 500; color: #495057;">Adresse Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box;">
            @error('email')
                <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 500; color: #495057;">Rôle Système</label>
            <select name="role" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 6px; background-color: white; box-sizing: border-box; cursor: pointer;">
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
            </select>
            @error('role')
                <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 500; color: #495057;">Site</label>
            <select name="site_id" style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 6px; background-color: white; box-sizing: border-box; cursor: pointer;">
                <option value="">-- Aucun site --</option>
                @foreach($sites as $site)
                    <option value="{{ $site->id }}" {{ old('site_id') == $site->id ? 'selected' : '' }}>
                        {{ $site->name }}
                    </option>
                @endforeach
            </select>
            @error('site_id')
                <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 500; color: #495057;">Mot de passe</label>
            <input type="password" name="password" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box;">
            @error('password')
                <span style="color: #dc3545; font-size: 0.85rem; display: block; margin-top: 4px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 500; color: #495057;">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 6px; box-sizing: border-box;">
        </div>

        <div style="display: flex; gap: 12px; justify-content: flex-end;">
            <a href="{{ route('users.index') }}" style="background: #6c757d; color: white; padding: 10px 16px; border-radius: 6px; text-decoration: none; font-size: 0.9rem; line-height: 1.5;">
                Annuler
            </a>
            <button type="submit" style="background: #198754; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; font-size: 0.9rem;">
                Enregistrer l'utilisateur
            </button>
        </div>
    </form>
</div>
@endsection
