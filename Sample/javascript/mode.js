var checkbox = document.getElementById('mode');

checkbox.addEventListener('change', (e)=> {
   document.body.classList.toggle('light');
   
   var theme;

   if(document.body.classList.contains('light')){
      console.log("light");
      theme = "LIGHT";
   }
   else{
      console.log("dark");
      theme = "DARK";
   }

   localStorage.setItem("PageTheme", JSON.stringify(theme));

});

let GetTheme = JSON.parse(localStorage.getItem("PageTheme"));

if(GetTheme === 'LIGHT'){
   checkbox.checked = true;
   document.body.classList = "light";
}