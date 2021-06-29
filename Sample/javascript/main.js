window.addEventListener('scroll', function() {
    let header = document.querySelector('header');

    header.classList.toggle('scrolling', window.scrollY > 0);
})



const slideContainer = document.querySelector('.slide-holder');
const slideImgs = document.querySelectorAll('.slide-holder  .imgHolder');


// SLIDER BUTTON NEXT AND PREV

//Buttons
const nxtBtn = document.querySelector('#nxtBtn');
const prvBtn = document.querySelector('#prevBtn');


let ctr = 1;
const size = slideImgs[0].clientWidth;
const imgLength = slideImgs.length - 2;
const lastImage = slideImgs[imgLength];

lastImage.id = 'firstImage';
slideContainer.style.transform = 'translateX(' + (-size * ctr) + 'px';



nxtBtn.addEventListener('click', function(){
    if(ctr >= slideImgs.length - 2) return;
    slideContainer.style.transition = 'ease-in-out .6s';
    ctr++;
    console.log(ctr);
    console.log(slideContainer.style.transform = 'translateX(' + (-size * ctr) + 'px');
    console.log(slideImgs[ctr].id);
});

prvBtn.addEventListener('click', function(){
    if(ctr <= 0) return;
    slideContainer.style.transition = 'ease-in-out .6s';
    ctr--;
    console.log(ctr);
    console.log(slideContainer.style.transform = 'translateX(' + (-size * ctr) + 'px');
});

slideContainer.addEventListener('transitionend', function(){
    if(slideImgs[ctr].id === 'lastImage'){
        slideContainer.style.transition = 'none';
        ctr = slideImgs.length - 3;
        slideContainer.style.transform = 'translateX(' + (-size * ctr) + 'px';
    }

    if(slideImgs[ctr].id === 'firstImage'){
        slideContainer.style.transition = 'none';
        ctr = slideImgs.length - ctr - 1;
        slideContainer.style.transform = 'translateX(' + (-size * ctr) + 'px';
    }
})





// LOGIN BUTTON
const loginContainer = document.querySelector('.login-container');

document.getElementById('login').addEventListener('click', function(){
    
    if(loginContainer.style.display === 'block'){
        loginContainer.style.display = 'none';
    }
    else{
        loginContainer.style.display = 'block';
    }  
})




const userLogin = document.querySelector('.user-login-container');

document.getElementById('isLogin').addEventListener('click', function(){
   if(userLogin.style.display === 'block'){
        userLogin.style.display = 'none'
   }
   else{
       userLogin.style.display = 'block';
   } 
});




// LIGHT AND DARK MODE SCRIPT 


var darkMode = document.getElementById('dark-mode');


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


function OnDarkMode(){
    light.style.background = 'rgb(17, 17, 26)';
    light.style.border = '1px solid white';
    img.style.right = '3%';
    img.style.filter = 'invert(0)';
    para.innerHTML = 'Light';
    para.style.color = 'white';
    para.style.left = '35%';
    img.src = './icon/light-icon.png';
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

function OffDarkMode(){
    light.style.background = 'white';
    light.style.border = '1px solid black';
    img.style.right = '62%';
    img.style.filter = 'invert(1)';
    para.innerHTML = 'Dark';
    para.style.color = 'black';
    para.style.left = '65%';
    img.src = './icon/dark-icon.png';
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

light.addEventListener('click', function(){
  if(darkMode === 'On'){
      OnDarkMode();
      darkMode = 'Off';
  }
  else{
      OffDarkMode();
      darkMode = 'On';
  }
});

console.log(darkMode);







