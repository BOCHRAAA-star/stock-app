<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Stock</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
        }

        nav {
            background: #0d6efd;
            padding: 15px;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            width: 90%;
            margin: 25px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }

        .btn-danger {
            background: #dc3545;
        }

        .alert {
            padding: 10px;
            background: #d1e7dd;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .error {
            color: #dc3545;
            font-size: 14px;
        }

        input, select {
            padding: 8px;
            width: 300px;
            max-width: 100%;
        }
    </style>
</head>

<body>

<nav>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('products.index') }}">Produits</a>

    @if(auth()->user()->isAdmin())
        <a href="{{ route('categories.index') }}">Catégories</a>
    @endif

    <a href="{{ route('stock-movements.index') }}">Mouvements</a>

    <form method="POST" action="{{ route('logout') }}" style="display:inline; float:right;">
        @csrf
        <button type="submit" style="background:#dc3545; border:none; color:white; font-weight:bold; cursor:pointer; padding:5px 12px; border-radius:4px;">
            Déconnexion
        </button>
    </form>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>





</body>
</html>
