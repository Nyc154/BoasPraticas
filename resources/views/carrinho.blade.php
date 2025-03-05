@extends('layouts.app')

@section('title', 'Carrinho de Compras')

@section('content')
    <div id="carrinho" class="section active">
        <h1>Carrinho de Compras</h1>
        <div class="cart-items"></div>
        <button onclick="payNow()">Pagar</button>
    </div>
@endsection
