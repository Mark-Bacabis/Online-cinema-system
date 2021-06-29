

// LIGHT AND DARK MODE SCRIPT 

// DARK-LIGHT CHANGE BUTTON
const light = document.querySelector('.light-mode');
const para = document.querySelector('.light-mode p');
const img = document.querySelector('.light-mode img');
const imgPosition = document.getElementById('icon').style.right;


// LOGIN MODAL
const loginBg = document.querySelector('.login-container');
const loginInput = document.querySelector('.login-container input');

// VARIABLE FOR BODY AND HEADER SEARCH
const body = document.querySelector('body');
const header = document.querySelector('.nav-search-area');
const loginImg = document.querySelector('.nav-search-area .login img');

const userLoginBg = document.querySelector('.user-login-container');

const changePassColor = document.querySelector('.chngePW');
const bookHistory = document.querySelector('.bkHistory');
const logoutBtn = document.querySelector('.logout');


light.style.background = 'rgb(17, 17, 26)';

light.addEventListener('click', function(){

    if(light.style.background === 'rgb(17, 17, 26)'){
        light.style.background = 'white';
        light.style.border = '1px solid black';
        img.style.right = '62%';
        img.style.filter = 'invert(1)';
        para.innerHTML = 'Dark';
        para.style.color = 'black';
        para.style.left = '65%';
        img.src = '../icon/dark-icon.png';
        loginImg.style.filter = 'invert(0)';

        body.style.background = 'white';
        body.style.color = 'black';
        header.style.background = 'white';
        loginBg.style.background = 'white';
        loginBg.style.color = 'black';
        userLoginBg.style.background = 'white';
        changePassColor.style.color = 'black';
        bookHistory.style.color = 'black';
        logoutBtn.style.color = 'black';
    }
    else{
        light.style.background = 'rgb(17, 17, 26)';
        light.style.border = '1px solid white';
        img.style.right = '3%';
        img.style.filter = 'invert(0)';
        para.innerHTML = 'Light';
        para.style.color = 'white';
        para.style.left = '35%';
        img.src = '../icon/light-icon.png';
        loginImg.style.filter = 'invert(1)';
        


        body.style.background = 'rgb(17, 17, 26)';
        body.style.color = 'white';
        header.style.background = 'rgb(17, 17, 26)';
        loginBg.style.background = 'rgb(17, 17, 26)';
        loginBg.style.color = 'white';
        userLoginBg.style.background = 'rgb(17, 17, 26)';
        changePassColor.style.color = 'white';
        bookHistory.style.color = 'white';
        logoutBtn.style.color = 'white';
    }
});