@extends('layouts.app')

@section('content')
    <h2>Catégories</h2>
    <a href="{{ route('categories.create') }}" class="btn">+ Ajouter</a>

    <table style="margin-top:15px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Produits</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->products_count }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn">Modifier</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Supprimer?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Aucune catégorie trouvée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
