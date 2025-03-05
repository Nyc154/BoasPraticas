<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Mercado Online')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Página Inicial</a></li>
            <li><a href="{{ route('comprar') }}">Comprar Produtos</a></li>
            <li><a href="{{ route('adicionar') }}">Adicionar Produtos</a></li>
            <li><a href="{{ route('carrinho') }}"><i class="fas fa-shopping-cart cart-icon"></i> Carrinho</a></li>
        </ul>
    </nav>
    <span id="cart-total-header" class="cart-total">Saldo: R$ 0.00</span>
</header>

<main>
    @yield('content')
</main>

</body>
</html>
