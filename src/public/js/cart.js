// Supprimer les éléments du panier

document.querySelectorAll('#delete-item').forEach(button => {
    button.addEventListener('click', event => {
        console.log('delete');
        let productId = event.target.dataset.id;
        let index = cart.indexOf(productId);
        cart.splice(index, 1);
        setCartCookie(cart);
        updateCart();
    }
    );
}
);