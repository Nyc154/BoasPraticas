@extends('layouts.app')

@section('title', 'Adicionar Produtos')

@section('content')
    <div class="section active">
        <h1>Adicionar Produtos</h1>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome-produto">Nome do Produto</label>
                <input type="text" id="nome-produto" name="name" required>
            </div>
            <div class="form-group">
                <label for="preco-produto">Preço do Produto (R$)</label>
                <input type="number" id="preco-produto" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="imagem-produto">URL da Imagem do Produto</label>
                <input type="url" id="imagem-produto" name="image_url" required>
            </div>
            <div class="form-group">
                <button type="submit">Adicionar Produto</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
