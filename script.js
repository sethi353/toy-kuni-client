// Load cart from localStorage
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Product list
const products = [
  {
    id: 1,
    name: "Teddy Bear",
    price: 15,
    image: "https://via.placeholder.com/200"
  },
  {
    id: 2,
    name: "Toy Car",
    price: 10,
    image: "https://via.placeholder.com/200"
  },
  {
    id: 3,
    name: "Doll",
    price: 20,
    image: "https://via.placeholder.com/200"
  }
];

const container = document.getElementById("product-container");
const cartCount = document.getElementById("cart-count");

// Update cart count
function updateCartCount() {
  cartCount.innerText = cart.length;
}

updateCartCount();

// Show products
products.forEach(product => {
  const card = document.createElement("div");

  card.innerHTML = `
    <div class="card bg-base-100 shadow-xl">
      <figure>
        <img src="${product.image}" alt="${product.name}">
      </figure>
      <div class="card-body">
        <h2 class="card-title">${product.name}</h2>
        <p>$${product.price}</p>
        <div class="card-actions justify-end">
          <button class="btn btn-primary" onclick="addToCart(${product.id})">
            Add to Cart
          </button>
        </div>
      </div>
    </div>
  `;

  container.appendChild(card);
});

// Add to cart function
function addToCart(id) {
  const product = products.find(p => p.id === id);

  cart.push(product);

  // Save to localStorage
  localStorage.setItem("cart", JSON.stringify(cart));

  updateCartCount();

  alert(product.name + " added to cart!");
}