window.addEventListener('scroll', function() {
    let header = document.querySelector('header');

    header.classList.toggle('scrolling', window.scrollY > 0);
})

// LOGIN BUTTON

// LOGIN MODAL
const loginContainer = document.querySelector('.login-container');

document.getElementById('login').addEventListener('click', function(){
    
    if(loginContainer.style.display === 'block'){
        loginContainer.style.display = 'none';
    }
    else{
        loginContainer.style.display = 'block';
    }  
})


// USER SETTING / LOGIN MODAL

const userLogin = document.querySelector('.user-login-container');

document.getElementById('isLogin').addEventListener('click', function(){
   if(userLogin.style.display === 'block'){
        userLogin.style.display = 'none'
   }
   else{
       userLogin.style.display = 'block';
   } 
});


