
function initPayPalButton() {
   
    paypal.Buttons({
      style: {
        shape: 'rect',
        color: 'gold',
        layout: 'horizontal',
        label: 'paypal',
        
      },

      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{"amount":{"currency_code":"USD","value":100}}]
        });
      },

      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            console.log(details);
          alert('Transaction completed by ' + details.payer.name.given_name + '!');
        });
      },

      onError: function(err) {
        console.log(err);
      }
    }).render('#paypal-btn');
  }


  initPayPalButton();