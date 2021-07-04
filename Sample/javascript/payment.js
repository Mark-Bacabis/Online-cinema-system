function initPayPalButton(price) {
  paypal.Buttons({
    style: {
      shape: 'pill',
      color: 'gold',
      layout: 'horizontal',
      label: 'pay',
    },

    createOrder: function(data, actions) {
      const totalPrice = document.getElementById('totalPrice').value;
      return actions.order.create({
        purchase_units: [{"description":"Sample Product","amount":{"currency_code":"PHP","value":342,"breakdown":{"item_total":{"currency_code":"PHP","value":totalPrice},"shipping":{"currency_code":"PHP","value":0},"tax_total":{"currency_code":"PHP","value":42}}}}]
      });
    },

    onApprove: function(data, actions) {
      return actions.order.capture().then(function(details) {
        alert('Transaction completed by ' + details.payer.name.given_name + '!');
      });
    },

    onError: function(err) {
      console.log(err);
    }
  }).render('#paypal-button-container');
}

initPayPalButton();