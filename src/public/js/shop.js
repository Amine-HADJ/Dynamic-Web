const productButtons = document.querySelectorAll('.cta-button');
const modal = document.querySelector('#modal');

productButtons.forEach((button) => {
  button.addEventListener('click', (event) => {
    const element = event.target.parentElement;
    const data = {
      link: element.querySelector('img').src, 
      title: element.querySelector('h3').innerHTML
    }

    modal.querySelector('#modal-image').src = data.link;
    modal.querySelector('#modal-title').innerHTML = data.title;
    modal.style.display = 'flex';
  });
});

document.addEventListener('click', (event) => {
  if (event.target.classList.contains('modal')) {
    event.target.style.display = 'none';
  }
});

modal.querySelector('.close').addEventListener('click', () => {
  modal.style.display = 'none';
});