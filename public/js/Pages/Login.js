let Loader2 = document.querySelector('.loader-2');
let Loader2X = document.querySelector('.loader-2 .x');
let LoaderPercentage = document.querySelector('.loader-2 p');
let Login = document.querySelector('.Login');
Loader2.style.display = 'none';
// 
const images = ['22.jpeg','1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg',
                '7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg',
                '13.jpg','14.jpg','15.jpg','16.jpeg','17.jpeg','18.jpeg',
                '19.jpeg',];

let currentIndex = 0;

function changeBackground() {
    document.querySelector('.Login').style.backgroundImage = 'url(' + window.location.href + 'images/Vessels/' + images[currentIndex] + ')';
    currentIndex = (currentIndex + 1) % images.length; 
}

changeBackground(); 
setInterval(changeBackground, 5000);
// 
setTimeout(() => {
    Login.style.display = 'flex'; 
}, 15000); 

let LoginButtonX = document.querySelector('.LoginButton');
let LoginForm = document.querySelector('.LoginForm');
let ErrorLogin = document.querySelector('.error-login');
let EmailInput = document.querySelector('input[name=Email]');
let PasswordInput = document.querySelector('input[name=Password]');

LoginButtonX.addEventListener('click', () => {
    if (EmailInput.value.trim() == '') { 
        ErrorLogin.style.display = 'block';
        ErrorLogin.textContent =  'Kindly enter your email';
    } else if (PasswordInput.value.trim() == '') { 
        ErrorLogin.style.display = 'block';
        ErrorLogin.textContent =  'Password is required';
    } else { 
        ErrorLogin.style.display = 'block';
        ErrorLogin.textContent =  'User Confirmation..';
        ErrorLogin.style.backgroundColor = '#62bd62';
        LoginButtonX.style.backgroundColor = '#ff3838';
        LoginButtonX.textContent = 'Verifying..';
        LoginForm.setAttribute('action', '/Auth');
        LoginForm.submit();
    }
})

