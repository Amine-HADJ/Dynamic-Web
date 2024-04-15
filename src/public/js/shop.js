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
