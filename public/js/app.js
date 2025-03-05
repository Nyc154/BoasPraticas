// Constants
const SECTIONS = document.querySelectorAll('.section');
const CART_ITEMS_CONTAINER = document.querySelector('.cart-items');
const CART_TOTAL_HEADER = document.getElementById('cart-total-header');
const TOTAL_ELEMENT = document.getElementById('total');
const TOTAL_CART_ELEMENT = document.getElementById('total-carrinho');
const NO_PRODUCTS_MESSAGE = 'Sem produtos adicionados.';

// State
let total = 0;
let cart = [];
let products = [];

// Functions
function showSection(sectionId) {
    SECTIONS.forEach(section => section.classList.remove('active'));
    document.getElementById(sectionId).classList.add('active');
    if (sectionId === 'carrinho') {
        updateCartDetails();
    }
}

function addToCart(button) {
    const productElement = button.parentElement;
    const name = productElement.querySelector('h2').textContent;
    const price = parseFloat(productElement.getAttribute('data-price'));
    const quantityInput = productElement.querySelector('.quantity-input');
    const quantity = parseInt(quantityInput.value);

    if (quantity > 0) {
        const existingProductIndex = cart.findIndex(item => item.name === name);
        if (existingProductIndex !== -1) {
            cart[existingProductIndex].quantity += quantity;
        } else {
            cart.push({ name, price, quantity });
        }

        updateCart();
        quantityInput.value = 1;
    } else {
        alert('Por favor, insira uma quantidade válida.');
    }
}

function updateCart() {
    if (CART_ITEMS_CONTAINER) {
        CART_ITEMS_CONTAINER.innerHTML = '';
    }
    total = 0;

    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <span>${item.name} - R$ ${(item.price * item.quantity).toFixed(2)} (${item.quantity}x)</span>
            <button onclick="removeFromCart('${item.name}', 1)">Remover 1</button>
            <button onclick="removeFromCart('${item.name}', ${item.quantity})">Remover todos</button>
        `;
        if (CART_ITEMS_CONTAINER) {
            CART_ITEMS_CONTAINER.appendChild(cartItem);
        }
        total += item.price * item.quantity;
    });

    if (CART_TOTAL_HEADER) {
        CART_TOTAL_HEADER.textContent = `Saldo: R$ ${total.toFixed(2)}`;
    }
    if (TOTAL_ELEMENT) {
        TOTAL_ELEMENT.textContent = total.toFixed(2);
    }
    if (TOTAL_CART_ELEMENT) {
        TOTAL_CART_ELEMENT.textContent = total.toFixed(2);
    }

    saveCart();
}

function removeFromCart(productName, quantity) {
    const existingProductIndex = cart.findIndex(item => item.name === productName);
    if (existingProductIndex !== -1) {
        const existingProduct = cart[existingProductIndex];
        if (existingProduct.quantity > quantity) {
            existingProduct.quantity -= quantity;
        } else {
            cart.splice(existingProductIndex, 1);
        }
        updateCart();
        updateCartDetails();
    }
}

function updateCartDetails() {
    const cartDetailsContainer = document.querySelector('#carrinho .cart-items');
    if (cartDetailsContainer) {
        cartDetailsContainer.innerHTML = '';
    }
    total = 0;

    cart.forEach(item => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <span>${item.name} - R$ ${(item.price * item.quantity).toFixed(2)} (${item.quantity}x)</span>
            <button onclick="removeFromCart('${item.name}', 1)">Remover 1</button>
            <button onclick="removeFromCart('${item.name}', ${item.quantity})">Remover todos</button>
        `;
        if (cartDetailsContainer) {
            cartDetailsContainer.appendChild(cartItem);
        }
        total += item.price * item.quantity;
    });

    if (TOTAL_CART_ELEMENT) {
        TOTAL_CART_ELEMENT.textContent = total.toFixed(2);
    }
}

function payNow() {
    alert('Pagamento realizado com sucesso!');
    cart = [];
    updateCart();
    updateCartDetails();
    showSection('home');
}

function addProduct() {
    const name = document.getElementById('nome-produto').value;
    const price = parseFloat(document.getElementById('preco-produto').value).toFixed(2);
    const imageUrl = document.getElementById('imagem-produto').value;

    if (name && price && imageUrl) {
        const productsContainer = document.querySelector('#comprar .products');
        const noProductsMessageElement = document.querySelector('.no-products');

        if (noProductsMessageElement) {
            noProductsMessageElement.remove();
        }

        const productElement = document.createElement('div');
        productElement.classList.add('product');
        productElement.setAttribute('data-price', price);
        productElement.innerHTML = `
            <h2>${name}</h2>
            <img src="${imageUrl}" alt="${name}">
            <p>R$ ${price}</p>
            <input type="number" class="quantity-input" value="1" min="1">
            <button onclick="addToCart(this)">Adicionar ao Carrinho</button>
            <button class="remove-button" onclick="removeProduct(this)">Remover Produto</button>
        `;
        productsContainer.appendChild(productElement);

        products.push({ name, price, imageUrl });

        alert(`Produto "${name}" adicionado com sucesso!`);

        document.getElementById('nome-produto').value = '';
        document.getElementById('preco-produto').value = '';
        document.getElementById('imagem-produto').value = '';
    } else {
        alert('Por favor, preencha todos os campos.');
    }
}

function removeProduct(button) {
    const productElement = button.parentElement;
    const name = productElement.querySelector('h2').textContent;

    products = products.filter(item => item.name !== name);
    productElement.remove();

    const productsContainer = document.querySelector('#comprar .products');
    if (products.length === 0) {
        const noProductsMessageElement = document.createElement('p');
        noProductsMessageElement.classList.add('no-products');
        noProductsMessageElement.textContent = NO_PRODUCTS_MESSAGE;
        productsContainer.appendChild(noProductsMessageElement);
    }
}

function saveCart() {
    fetch('/save-cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ items: cart, total: total })
    }).then(response => response.json())
      .then(data => {
          if (!data.success) {
              alert('Erro ao salvar o carrinho.');
          }
      });
}

function loadCart() {
    fetch('/get-cart')
        .then(response => response.json())
        .then(data => {
            cart = data.items;
            total = data.total;
            updateCart();
        })
        .catch(error => {
            console.error('Erro ao carregar o carrinho:', error);
        });
}

// Carregar o carrinho ao carregar a página
document.addEventListener('DOMContentLoaded', loadCart);
