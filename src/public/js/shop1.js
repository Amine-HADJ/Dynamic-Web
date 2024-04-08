const productButtons = document.querySelectorAll('.cta-button');
const modal = document.querySelector('#modal');

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
};

document.addEventListener('click', (event) => {
  if (event.target.classList.contains('modal')) {
    event.target.style.display = 'none';
  }
});

modal.querySelector('.close').addEventListener('click', () => {
  modal.style.display = 'none';
});