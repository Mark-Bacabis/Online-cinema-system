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
        <div class="details-container movie">
            
            <div class="movie-info">
                <table border="0">
                    <tr>
                        <td> <h2 id="title"> <?=$movieResult['Title']?> </h2> </td>
                        <td rowspan="2" class="numberOfseat"> <span class="seatNo">  <?=$numberOfSeats?> </span> <br> seats </td>
                    </tr>
                    <tr>
                        <td> <h2> Fairview Terraces, <?=$cinema?> </h2></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td> <h3> <?=$date?> </h3></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td> <h3> <?=$showTime?> </h3></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <h3> 
                                <?php foreach($seats as $seatNumber){ 
                                    echo $seatNumber.", ";
                                }?>
                            </h3>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"> <hr> </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td> <p> Subtotal </p> </td>
                        <td> <?=$totalPrice?></td>
                    </tr>
                    <tr>
                       
                        <td> <h3> Payable Amount </h3> </td>
                        <td class="total-price">  
                            <div class="overflow">
                                
                            </div> 
                        <input type="text" name="totalPrice" id="totalPrice" value="<?=$totalPrice?>"></td>
                    </tr>
                </table>
            </div>

            <div class="payment-info-container">
               <table border="0">
                    <tr>
                        <td> <h1> Payment </h1></td>
                    </tr>
                   <tr>
                       <td colspan="2"> 
                            <p> Name on card </p> 
                            <input type="text">
                       </td>
                   </tr>
                   <tr>
                       <td colspan="2"> 
                            <p> Card number </p> 
                            <input type="text">
                       </td>
                   </tr>
                   <tr>
                       <td> 
                            <p> Expiration Date </p> 
                            <input type="text" placeholder="MM/YYYY">
                       </td>
                       <td> 
                            <p> CV Code </p> 
                            <input type="text">
                       </td>
                   </tr>
                   <tr>
                       <td colspan="2"> 
                           <input type="submit" value="Pay">
                       </td>
                   </tr>
                   <tr>
                       <td colspan="2"> 
                           <p class="divider"> Or select other payment method </p>
                       </td>
                   </tr>
                   <tr>
                        <td colspan="2"> 
                            <div id="paypal-button-container"></div>
                        </td>
                   </tr>
               </table>
            </div>
        </div>
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

<script src="https://www.paypal.com/sdk/js?client-id=Adzt_0adAQxrjsrP4e4lhWQpAUEMT3S1H04fhsHXK-WONYLtw2ZrCkFDKEmx3_Gsi6WQNN4SEUCe-rhn&currency=USD"></script>
    
<script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({
            
            style: {
                layout: 'horizontal',
                color: 'gold',
                shape: 'pill'
            },
            
            // Set up the transaction
            createOrder: function(data, actions) {
                const price = document.getElementById('totalPrice').value;
                const title = document.getElementById('title').innerHTML;
                return actions.order.create({
                    purchase_units: [{
                        description: title,
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
                    // Show a success message to the buyer
                    alert('Transaction completed by ' + details.payer.name.given_name + '!');
                });
            }
        }).render('#paypal-button-container');
</script>
</body>
</html>