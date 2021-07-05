<?php
    session_start();
    include "./connection.php";

    $movieID = $_SESSION['movieID'];
    $userID = $_SESSION['userID'];
    $seats = $_POST['seat'];
    $date = $_POST['date'];
    $cinema = $_POST['cinema'];
    $showTime = $_POST['showTime'];
    $priceTicket = $_POST['price'];
    $numberOfSeats = $_POST['nthOfSeats'];
    $seatNumbers = $_POST['seatNo'];
    $totalPrice = $_POST['totalPrice'];


    //SESSION
    $_SESSION['movieID'] = $movieID;
    $_SESSION['userID'] = $userID;
    $_SESSION['seats'] = $seats;
    $_SESSION['date'] = $date;
    $_SESSION['cinema'] = $cinema;
    $_SESSION['showTime'] = $showTime;
    $_SESSION['priceTicket'] = $priceTicket;
    $_SESSION['numberOfseats'] = $numberOfSeats;
    $_SESSION['seatNumbers'] = $seatNumbers;
    $_SESSION['totalPrice'] = $totalPrice;


    // FOR USER
    $userQuery = mysqli_query($conn, "SELECT * FROM user WHERE userID = '$userID'");
    $userResult = mysqli_fetch_assoc($userQuery);

    // FOR MOVIE
    $movieQuery = mysqli_query($conn, "SELECT * FROM movie WHERE movieID = '$movieID'");
    $movieResult = mysqli_fetch_assoc($movieQuery);

    // FOR TIME SHOW
    $query = mysqli_query($conn, "SELECT * FROM show_time WHERE showStart = (SELECT DISTINCT LEFT('$showTime', 8) FROM show_time)");
    $showResult = mysqli_fetch_assoc($query);

    // FOR CINEMA NAME AND NUMBER
    $cinemaQuery = mysqli_query($conn, "SELECT * FROM cinema WHERE cinemaName = '$cinema'");
    $cinemaResult = mysqli_fetch_assoc($cinemaQuery);

    $showID = $showResult['showID'];
    $userEmail = $userResult['email'];
    $cinemaID = $cinemaResult['cinemaID'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/payment.css">
    <title>Document</title>
</head>

<!-- IF USER LOG IN OR NOT -->
<?php
        if($userID != null){?>
            <style>
                #isNotLogin{
                    display: none;
                }
                #isLogin{
                    display: flex;
                }
            </style>
        <?php } elseif($userID == null) { ?>
            <style>
                #isNotLogin{
                    display: flex;
                }
                #isLogin{
                    display: none;
                }
            </style>

    <?php } ?>
<!-- IF USER LOG IN OR NOT -->
<body>
   
    <header>
        <div class="logo">
            <a href="../index.php"> NXTFLIX <br>
                <span class="subtitle">
                    Online Ticket Reservation
                </span>
            </a>   
        </div>
        <div class="title">
            <h1> Payment </h1>
        </div>

        <div class="user-account">
                <div class="user-name">
                    <p> <?=$userResult['firstName']?> <?=$userResult['lastName']?></p>
                </div>
                <div class="profile-pic">
                    <img src="./user-profile/<?=$userResult['profile']?>" alt="">
                </div>
        </div>
    </header>
    <div class="payment-container">
        <div class="button-container">
            <form action="" method="POST">
                <h1> Credit Card Information </h1>
                <table border="0">
                    <tr>
                        <td>
                            <label> Card on Name </label> <br>
                            <input type="text" name="" id="">
                        </td>
                        <td>
                            <label> Expiration </label> <br>
                            <input type="text" name="" id="">
                            <input type="text" name="" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label> Card Number </label> <br>
                            <input type="text" name="" id="">
                        </td>
                        <td>
                            <label> CV Code </label> <br>
                            <input type="text" name="" id="">
                        </td>
                    </tr>
                </table>
                <div class="buttons">
                    <input type="submit" name="cancel" value="Cancel" class="cancel">
                    <input type="submit" name="pay" value="PAY" class="pay">
                </div>
                
            </form>
            <p> OR </p>
            <div id="paypal-button-container"></div>

            <div class="user-details">
                <table border="0">
                    <th colspan="2"> USER CONTACT </th>
                    <tr>
                        <td>
                            Email <br>
                            <input type="email" name="user-email" value="<?=$userResult['email']?>">
                        </td>
                        <td>
                            Contact
                            <input type="email" name="user-number" value="<?=$userResult['contactNumber']?>">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <table class="table" border="0">
            <tr>
                <td colspan="2"> <h1 id="title"> <?=$movieResult['Title']?> </h2></td>
                
            </tr>
            <tr>
                <td colspan="2"> 
                    <h4> Fairview Terraces,  <?=$cinemaResult['cinemaName']?> </h4>
                </td> 
            </tr>
            <tr>
                <td colspan="2"> 
                    <h2> <?=$date?> </h2>
                </td> 
            </tr>
            <tr>
                <td colspan="2"> 
                    <h3> 
                        <?php
                            foreach($seats as $seatNum){
                                echo $seatNum." ";
                            }
                        ?>
                    </h3>
                </td> 
            </tr>
            <tr>
                <td colspan="2"> 
                    <h3> <?=$showResult['showName']?> Time: <?=$showResult['showStart']?> - <?=$showResult['showEnd']?></h3>
                </td> 
            </tr>
            <tr>
               <td colspan="2"> <hr> </td>
            </tr>
            <tr>
               <td> <p> Ticket price </p> </td>
               <td class="rigth"> <?=$priceTicket?> </td>
            </tr>
            
            <tr>
               <td> <p> Number of tickets </p> </td>
               <td class="rigth"> <?=$numberOfSeats?> </td>
            </tr>
            <tr>
               <td> <p> Subtotal </p> </td>
               <td class="rigth"> <?=$totalPrice?> </td>
            </tr>
            <tr>
               <td> <p> Tax Rate(14%) </p> </td>
               <td class="rigth"> 14.00 </td>
            </tr>
            <tr class="payable-amount">
               <td> <h3> Payable Amount </h3> </td>
               <td class="rigth">
                    <input type="text" name="totalPrice" id="totalPrice" value="<?=$totalPrice + 14.00?>.00">
                    <div class="overlay">

                    </div>
                </td>
            </tr>
        </table>

    </div>




    <footer>
        <div class="copyright">
            &copy; NxtGen &bullet; 2021  &bullet; &copy;
        </div>

        <div class="nav-links">
            <ul>
                <li> <a href="#"> Home </a> </li>
                <li> <a href="#"> Terms and agreements </a> </li>
                <li> <a href="#"> Services </a> </li>
                <li> <a href="#"> Privacy policy</a> </li>
            </ul>
        </div>
    </footer>

<!-- SCRIPT FOR PAYPAL -->

<script src="https://www.paypal.com/sdk/js?client-id=Adzt_0adAQxrjsrP4e4lhWQpAUEMT3S1H04fhsHXK-WONYLtw2ZrCkFDKEmx3_Gsi6WQNN4SEUCe-rhn&currency=PHP"></script>
    
<script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            
            style: {
                layout: 'horizontal',
                color: 'gold',
                shape: 'pill',
                label: 'pay',
            },
            
            // Set up the transaction
            createOrder: function(data, actions) {
                const price = document.querySelector('#totalPrice').value;
                const title = document.querySelector('#title').innerHTML;
                return actions.order.create({
                    purchase_units: [{
                        description:title,
                        amount: {
                            value:price
                        },
                        tax_total:{
                            value:42
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                   window.location = "http://localhost/online-cinema-system/sample/process/payment-process.php";
                });
            }
        }).render('#paypal-button-container');
</script>
</body>
</html>