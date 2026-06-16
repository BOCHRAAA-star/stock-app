@extends('layouts.app')

@section('content')
    <h1>Mouvements de stock</h1>

    <a class="btn" href="{{ route('stock-movements.create') }}">
        Nouveau mouvement
    </a>

    <br><br>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Produit</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Note</th>
                <th>Nom de l'utilisateur</th>
                @if(auth()->user()->isSuperAdmin())
                    <th>Site</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @foreach($movements as $movement)
                <tr>
                    <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $movement->product->name }}</td>

                    <td>
                        @if($movement->type === 'in')
                            Entrée
                        @else
                            Sortie
                        @endif
                    </td>

                    <td>{{ $movement->quantity }}</td>
                    <td>{{ $movement->note }}</td>
                    <td>{{ $movement->user_name ?? '-' }}</td>

                    @if(auth()->user()->isSuperAdmin())
                        <td>{{ $movement->site->name ?? '-' }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $movements->links() }}
@endsection
