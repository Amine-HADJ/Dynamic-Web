const sw = document.querySelectorAll('.switch');
const login = document.querySelector('.login');
const register = document.querySelector('.register');
var state = true;

sw.forEach((button) => {
    button.addEventListener('click', flip);
});

function flip () {
    if (state){
        login.style.display = 'flex';
        register.style.display = 'none';
    } else {
        register.style.display = 'flex';
        login.style.display = 'none';
    }  
    state=!state;
}