<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
    <header>
        <nav>
            <ul>
                <li><a onclick="mostrarSecao('home')">Página Inicial</a></li>
                <li><a onclick="mostrarSecao('comprar')">Comprar Produtos</a></li>
                <li><a onclick="mostrarSecao('adicionar')">Adicionar Produtos</a></li>
                <li><a onclick="mostrarSecao('carrinho')"><i class="fas fa-shopping-cart cart-icon"></i>Carrinho</a></li>
            </ul>
        </nav>
        <span id="cart-total-header" class="cart-total">Saldo: R$ 0.00</span>
    </header>

    <div id="home" class="section active">
        <h1>Bem-vindo ao Mercado Online</h1>
        <p>Aqui você encontra os melhores produtos!</p>
    </div>
    <div id="comprar" class="section">
        <h1>Comprar Produtos</h1>
        <div class="products">
            <p class="no-products">Sem produtos adicionados.</p>
        </div>
        <div class="cart">
            <h2>Carrinho de Compras</h2>
            <div class="cart-items"></div>
            <div class="cart-total">Total: R$ <span id="total">0.00</span></div>
        </div>
    </div>
    <div id="adicionar" class="section">
        <h1>Adicionar Produtos</h1>
        <div class="form-group">
            <label for="nome-produto">Nome do Produto</label>
            <input type="text" id="nome-produto" required>
        </div>
        <div class="form-group">
            <label for="preco-produto">Preço do Produto (R$)</label>
            <input type="number" id="preco-produto" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="imagem-produto">URL da Imagem do Produto</label>
            <input type="url" id="imagem-produto" required>
        </div>
        <div class="form-group">
            <button onclick="adicionarProduto()">Adicionar Produto</button>
        </div>
    </div>
    <div id="carrinho" class="section">
        <h1>Seu Carrinho</h1>
        <div class="cart">
            <h2>Itens no Carrinho</h2>
            <div class="cart-items"></div>
            <div class="cart-total">Total: R$ <span id="total-carrinho">0.00</span></div>
        </div>
        <div class="payment-methods">
            <h2>Formas de Pagamento</h2>
            <p>Escolha sua forma de pagamento:</p>
            <select>
                <option value="credit-card">Cartão de Crédito</option>
                <option value="debit-card">Cartão de Débito</option>
                <option value="paypal">PayPal</option>
                <option value="boleto">Boleto Bancário</option>
            </select>
        </div>
        <div class="form-group">
            <button onclick="pagarAgora()">Pagar</button>
        </div>
    </div>
    </body>
</html>
