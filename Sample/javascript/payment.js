const paypalClicked = document.querySelector(".paypal");
const creditBtnClicked = document.querySelector(".credit-btn");
const totalPrice = document.getElementById("totalPrice").value;



const paypalContainer = document.querySelector(".paypal-payment");
const creditContainer = document.querySelector(".credit-container");

paypalClicked.addEventListener('click', function(){
  paypalContainer.style.display = "flex";
  creditContainer.style.display = "none";

  paypalClicked.style.background = "whitesmoke";
  paypalClicked.style.color = "black";
  creditBtnClicked.style.color = "white";
  creditBtnClicked.style.background = "rgb(184, 18, 51)";
});

creditBtnClicked.addEventListener('click', function(){
  paypalContainer.style.display = "none";
  creditContainer.style.display = "block";


  creditBtnClicked.style.background = "whitesmoke";
  creditBtnClicked.style.color = "black";
  paypalClicked.style.color = "white";
  paypalClicked.style.background = "rgb(184, 18, 51)";
 
});










paypal.Buttons({
  style:{
      color: "gold",
      shape: "pill",
      label: "pay",
  },
createOrder: function(data, actions) {
// This function sets up the details of the transaction, including the amount and line item details.
return actions.order.create({
  purchase_units: [{
    amount: {
      value: totalPrice
    }
  }]
});
},
onApprove: function(data, actions) {
// This function captures the funds from the transaction.
return actions.order.capture().then(function(details) {
  console.log(details);
  alert("Thank you for buying!!");
  window.location.replace("http://localhost/online-cinema-system/sample/php/payment-process.php");
});
},
onCancel: function(data) {
  alert("You cancel the payment");
}
}).render('#paypal-btn');
//This function displays Smart Payment Buttons on your web page.



