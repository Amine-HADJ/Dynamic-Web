document.querySelectorAll("#delete-item").forEach((button) => {
  button.addEventListener("click", (event) => {
    console.log("delete");
    let productId = event.target.dataset.id;

    let cart = document.cookie
      .split(";")
      .find((cookie) => cookie.trim().startsWith("cart="))
      .valueOf()
      .split("=")[1];

    cart = JSON.parse(cart);
    cart.splice(cart.indexOf(productId), 1);

    document.cookie = `cart=${JSON.stringify(cart)}; path=/`;
    location.reload();
  });
});
