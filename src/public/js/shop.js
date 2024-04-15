const productButtons = document.querySelectorAll('.cta-button');
const modal = document.querySelector('#modal');
const transi = document.querySelector('.fade-in');

productButtons.forEach((button) => {
  button.addEventListener('click', handleButton);
});

async function handleButton(event) {
  const element = event.target.parentElement;
  const productId = element.dataset.id;
  let result = await fetch(`../../Database/FetchProduct.php?query=${productId}`)
      .then(data => data.json());
  result = result[0];
  
  
  
  modal.querySelector('#modal-image').src = result.image;
  modal.querySelector('#modal-title').innerHTML = result.title;
  modal.querySelector('#modal-price').innerHTML = result.price;
  modal.querySelector('.modal-button').href = result.link;
  modal.style.display = 'flex';
  setTimeout(() => {
    modal.style.opacity = 1;
  }, 50); 
};

document.addEventListener('click', (event) => {
  if (event.target.classList.contains('modal')) {
    modal.style.opacity = 0;
    setTimeout(() => {
      event.target.style.display = 'none';
    }, 400); 
  }
});

modal.querySelector('.close').addEventListener('click', () => {
  modal.style.opacity = 0;
  setTimeout(() => {
    modal.style.display = 'none';
  }, 400);
});


// Ajout des produits dans le panier

let cart = getCartFromCookie() || [];

document.querySelectorAll('.add-to-cart-button').forEach(button => {
    button.addEventListener('click', event => {
        let productId = event.target.dataset.id;
        cart.push(productId);
        setCartCookie(cart);
    });
});

function getCartFromCookie() {
    let cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim().split('=');
        if (cookie[0] === 'cart') {
            return JSON.parse(cookie[1]);
        }
    }
    return [];
}

function setCartCookie(cart) {
    let cookieValue = JSON.stringify(cart);
    let expires = new Date();
    expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000)); // expires in 30 days
    document.cookie = 'cart=' + cookieValue + ';expires=' + expires.toUTCString() + ';path=/';
}

