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



