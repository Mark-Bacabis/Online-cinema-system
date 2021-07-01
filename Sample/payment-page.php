<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/payment.css">
    <title>Document</title>
</head>
<body>
    <div class="payment-container">
        <div class="payment">
            <table border="0" class="credit">
                <tr>
                    <td colspan="2"> <h2> Credit Card Information </h2> </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <h3> Name on Card </h3>
                        <input type="text">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <h3> Card Number </h3>
                        <input type="text">
                    </td >
                </tr>
                <tr  class="flex">
                    <td> 
                        <h3> CVC </h3>
                        <input type="text">
                    </td>
                    <td>
                        <h3> Expiration </h3>
                        <input type="text">
                        <input type="text">
                    </td>
                </tr>
            </table>

            <div class="divider">
                <hr> <p> Or </p> <hr> 
            </div>
            <input type="text" id="totalPayment">
            <div class="paypal-container" id="paypal-btn">
                <p> Checkout on </p>
            </div>
        </div>
        
    </div>

<!-- SCRIPT FOR PAYPAL -->
<script src="https://www.paypal.com/sdk/js?client-id=AbryZoPe6HcjxWJ91N3L7HN4-uFkrowPEEjnOuu9WN47VaEhycCQXXlzXScG9mQiPFpD99XDGREWjqH-&disable-funding=credit,card"> </script>
<script src="./javascript/payment.js"> </script>
</body>
</html>