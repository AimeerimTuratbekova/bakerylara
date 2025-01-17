let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}

let shoppingCart = document.querySelector('.shopping-cart');

document.querySelector('#cart-btn').onclick = () =>{
    shoppingCart.classList.toggle('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}

let loginForm = document.querySelector('.login-form');

document.querySelector('#login-btn').onclick = () =>{
    loginForm.classList.toggle('active');
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
}

window.onscroll = () =>{
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}

const cart = []; // Array to store cart items

// Function to add item to cart
function addToCart(itemName, itemPrice) {
    // Check if item already exists in cart
    const existingItem = cart.find(item => item.name === itemName);
    if (existingItem) {
        existingItem.quantity++; // Increase quantity if exists
    } else {
        cart.push({ name: itemName, price: parseFloat(itemPrice), quantity: 1 });
    }
    updateCart(); // Update cart display
}

// Function to update the cart display
function updateCart() {
    const cartItemsContainer = document.querySelector('.cart-items-container');
    const cartTotal = document.querySelector('.total');
    cartItemsContainer.innerHTML = ""; // Clear previous items
    let total = 0;

    // Render cart items
    cart.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.innerHTML = `${item.name} - $${item.price} x ${item.quantity}`;
        cartItemsContainer.appendChild(itemElement);
        total += item.price * item.quantity;
    });

    // Update total price
    cartTotal.innerText = `Total: $${total.toFixed(2)}`;
}

// Add event listeners to "Add to Cart" buttons
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
        const itemName = button.getAttribute('data-name');
        const itemPrice = button.getAttribute('data-price');
        addToCart(itemName, itemPrice);
    });
});
