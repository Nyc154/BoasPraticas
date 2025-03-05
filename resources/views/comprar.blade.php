@extends('layouts.app')

@section('title', 'Comprar Produtos')

@section('content')
    <div class="section active" id="comprar">
        <h1>Comprar Produtos</h1>
        <div class="products">
            @forelse ($products as $product)
                <div class="product" data-price="{{ $product->price }}">
                    <h2>{{ $product->name }}</h2>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    <p>R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                    <input type="number" class="quantity-input" value="1" min="1">
                    <button onclick="addToCart(this)">Adicionar ao Carrinho</button>
                    <button class="remove-button" onclick="removeProduct(this)">Remover Produto</button>
                </div>
            @empty
                <p class="no-products">Sem produtos adicionados.</p>
            @endforelse
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
