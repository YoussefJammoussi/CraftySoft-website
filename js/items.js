var cart = {};

function addToCart(productId, productName, price) {
    if (cart[productId]) {
        cart[productId].quantity++;
    } else {
        cart[productId] = {
            name: productName,
            price: price,
            quantity: 1
        };
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
}

function removeFromCart(productId) {
    if (cart[productId]) {
        delete cart[productId];
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCart();
    }
}

function updateCart() {
    var cartItemsContainer = document.getElementById('cart-items');
    var totalPriceElement = document.getElementById('total-price');
    var totalPrice = 0;

    cartItemsContainer.innerHTML = '';

    for (var productId in cart) {
        var product = cart[productId];
        var itemTotalPrice = product.price * product.quantity;
        totalPrice += itemTotalPrice;

        var row = document.createElement('tr');

        var nameCell = document.createElement('td');
        nameCell.textContent = product.name;
        nameCell.classList.add('center-text');
        nameCell.style.border = '1px solid white';
        nameCell.style.padding = '8px';
        row.appendChild(nameCell);

        var priceCell = document.createElement('td');
        priceCell.textContent = product.price;
        priceCell.classList.add('center-text');
        priceCell.style.border = '1px solid white';
        priceCell.style.padding = '8px';
        row.appendChild(priceCell);

        var quantityCell = document.createElement('td');
        quantityCell.textContent = product.quantity;
        quantityCell.classList.add('center-text');
        quantityCell.style.border = '1px solid white';
        quantityCell.style.padding = '8px';
        row.appendChild(quantityCell);

        var itemTotalCell = document.createElement('td');
        itemTotalCell.textContent = itemTotalPrice + ' грн';
        itemTotalCell.classList.add('center-text');
        itemTotalCell.style.border = '1px solid white';
        itemTotalCell.style.padding = '8px';
        row.appendChild(itemTotalCell);

        var removeButtonCell = document.createElement('td');
        var removeButton = document.createElement('button');
        removeButton.textContent = 'Видалити';
        removeButton.className = 'delete-button';
        removeButton.onclick = function (productId) {
            return function () {
                removeFromCart(productId);
            };
        }(productId);
        removeButtonCell.appendChild(removeButton);
        removeButtonCell.style.border = '1px solid white';
        removeButtonCell.style.padding = '8px';
        row.appendChild(removeButtonCell);

        cartItemsContainer.appendChild(row);
    }

    // Оновити загальну суму у локальному сховищі
    localStorage.setItem('totalPrice', totalPrice);

    // Оновити відображення загальної суми на сторінці
    totalPriceElement.textContent = totalPrice;
}

window.onload = function () {
    var savedCart = localStorage.getItem('cart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
        updateCart();
    }
};