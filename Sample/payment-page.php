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


    $userQuery = mysqli_query($conn, "SELECT * FROM user WHERE userID = '$userID'");
    $userResult = mysqli_fetch_assoc($userQuery);

    $movieQuery = mysqli_query($conn, "SELECT * FROM movie WHERE movieID = '$movieID'");
    $movieResult = mysqli_fetch_assoc($movieQuery);

    $query = mysqli_query($conn, "SELECT * FROM show_time WHERE showStart = (SELECT DISTINCT LEFT('$showTime', 8) FROM show_time)");
    $showResult = mysqli_fetch_assoc($query);

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
    <link rel="stylesheet" href="./styles/style.css">
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
            <h1> NXTFLIX </h1>
        </div>

        <div class="account">
            <h3> <?=$userResult['firstName']?> <?=$userResult['lastName']?> </h3>
            <div class="profile">
                <img src="./icon/login.png" id="isNotLogin" >
                <img src="./user-profile/<?=$userResult['profile']?>" id="isLogin" >
            </div>
        </div>
    </header>


    <div class="payment-container">
        <div class="payment-box">
            <div class="button-container">
                <h3> Payment Options: </h3>
                <button class="paypal"> Paypal </button>
                <button class="credit-btn"> Credit Card </button>
            </div>

            <div class="credit-container">
                <div class="credit-payment">
                    <table border="0">
                        <tr>
                            <td colspan="2"> <h2> Payment Options </h2> </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h3> Name on Card </h3> 
                                <input type="text" name="" placeholder="Ex. Juan Dela Cruz">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <h3> Card Number </h3> 
                                <input type="text" name="" placeholder="1234 5678 9012 3456">
                            </td>
                        </tr>
                        <tr class="flex">
                            <td>
                                <h3> Code </h3> 
                                <input type="text" name="" id="" placeholder="****">
                            </td>
                            <td>
                                <h3> Expiration </h3> 
                                <input type="text" name="" maxlength="2" placeholder="MM">
                                <input type="text" name="" maxlength="4" placeholder="YYYY">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pay-now-btn"> Pay now </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                               <div class="divider">  
                                   <hr> <p> Or </p> <button > Pay later </button> <hr>
                               </div>
                            </td>
                        </tr>
                    </table>   
                    
                </div>
            </div>

           
            <div class="paypal-payment">
                <div id="paypal-btn"> </div>
            </div>
        </div>

        <div class="movie-selected">
            <img src="./img/<?=$movieResult['Poster']?>" alt="">
        </div>
       
        <div class="order-summary-container">
            <table border="0">
                <tr>
                    <th> <h2> Booking Summary </h2></th>
                </tr>
                <tr>
                    <td> <h3> <?=$movieResult['Title']?> </h3></td>
                    <td class="center"> <p class="ticket"> <?=$numberOfSeats?> </p> <p> Ticket(s) </p> </td>
                </tr>
                <tr>
                    <td> <?=$cinema?>, Fairview Terraces </td>
                    <td></td>
                </tr>
                <tr>
                    <td> 
                        <h4> <?=$seatNumbers?></h4> 
                        <h4> <?=$date?> </h4> 
                        <h4> <?=$showTime?> </h4> 
                    </td>
                    <td> </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td> Price (per head) </td>
                    <td> <?=$movieResult['Price']?> </td>
                </tr>
                <tr>
                    <td> Number of seats </td>
                    <td> <?=$numberOfSeats?> </td>
                </tr>
                <tr>
                    <td> Total </td>
                    <td> <?=$totalPrice?> </td>
                </tr>

                <tr >
                    <td class="amount-payable"> Amount Payable </td>
                    <td class="amout"> 
                        <div class="price-overlay">
                        </div> 
                        <input type="text" id="totalPrice" value="<?=$totalPrice?>"> 
                    </td>
                </tr>
                
            </table>
        </div>

        
    </div>
    


<!-- FOOTER -->
    <footer class="footer-container">
        <div class="About">
            <h3> About </h3>
            <ul>
                <li><a href="#"> About us</a></li>
                <li><a href="#"> Terms and agreement </a></li>
                <li><a href="#"> Privacy Policy </a></li>
                <li><a href="#"> Services </a></li>
            </ul>
        </div>
        <div class="movies">
                <h3> Movies </h3>
            <ul>
                <li><a href="#"> Now showing </a></li>
                <li><a href="#"> New release </a></li>
                <li><a href="#"> Premiere </a></li>
                <li><a href="#"> Upcoming movie </a></li>
            </ul>
        </div>
        <div class="links">
                 <h3> Links </h3>
            <ul>
                <li><a href="#"> Home </a></li>
                <li><a href="#"> Movies</a></li>
                <li><a href="#"> Contact Us </a></li>
                <li><a href="#"> Services </a></li>
            </ul>
        </div>
        <div class="contactUs">
                <h3> Contact us </h3>
                <input type="text" placeholder="juandelacruz@email.com">
                <textarea name="message" id="" cols="0" rows="4" placeholder="Message us..." resize="none"></textarea>
                <button> Submit </button>
        </div>
        <div class="followUs">
            <h3> Follow us </h3>
            <ul>
                <li><a href="#"><img src="./icon/facebook.png" alt=""></a></li>
                <li><a href="#"><img src="./icon/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="./icon/instagram.png" alt=""></a></li>
            </ul>
        </div>
        <div class="copyright">
            <p> &copy; NXTGen 2021 </p>
        </div>
    </footer>
<!-- FOOTER -->


<!-- SCRIPT FOR PAYPAL -->
<script
    src="https://www.paypal.com/sdk/js?client-id=AbryZoPe6HcjxWJ91N3L7HN4-uFkrowPEEjnOuu9WN47VaEhycCQXXlzXScG9mQiPFpD99XDGREWjqH-&currency=PHP&disable-funding=credit,card"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
</script>
<script src="./javascript/payment.js"> </script>
</body>
</html>