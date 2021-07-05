<?php
    session_start();
    include "../connection.php";
    //SESSION
     $transactID = $_SESSION['transactID'];
     $movieID = $_SESSION['movieID'];
     $userID = $_SESSION['userID'];
     $seats = $_SESSION['seats'];
     $date = $_SESSION['date'];
     $cinema = $_SESSION['cinema'];
     $showTime = $_SESSION['showTime'];
     $priceTicket = $_SESSION['priceTicket'];
     $numberOfSeats = $_SESSION['numberOfseats'];
     $seatNumbers = $_SESSION['seatNumbers'];
     $totalPrice = $_SESSION['totalPrice'];

    // FOR USER
    $userQuery = mysqli_query($conn, "SELECT * FROM user WHERE userID = '$userID'");
    $userResult = mysqli_fetch_assoc($userQuery);

    // FOR MOVIE
    $movieQuery = mysqli_query($conn, "SELECT * FROM movie WHERE movieID = '$movieID'");
    $movieResult = mysqli_fetch_assoc($movieQuery);

    //FOR TRANSACTION 
    $bookQuery = mysqli_query($conn, "SELECT * FROM `booking_tbl` WHERE bookID = '$transactID '
    ");
    $bookID = mysqli_fetch_assoc($bookQuery);



    $email_to = $userResult['email'];
    $subject = "NXTFLIX";
    $message = "THANK YOU FOR CHOOSING US. This is your transaction ID ".$transactID;
    $header = "From: nxtflix.online.system.demo@gmail.com";

    mail($email_to, $subject, $message, $header);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/thankyou.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="thankyou-box">
            <img src="../icon/checked-crimson.png" alt="">
            <h1> THANK YOU!! </h1>
            <p> For choosing <span> NXTFLIX </span></p>
            <hr>
            <p> Your booking for </p>
            <h2>  <?=$movieResult['Title']?> (<?=$movieResult['Year']?>) </h2>
            <p> on </p>
            <h3> <?=$date?> (<?=$showTime?>)</h3>
            <p> at </p>
            <h3> Fairview Terraces, <?=$cinema?></h3>
            <p> are confirm! </p>
            <p> Your transaction ID is <font color="white"><b> <?=$bookID['bookID']?> </font> </b></p>
            <p>  We also send your transaction details to this email <font color="crimson"> <?=$userResult['email']?> </font></p>
        </div>

        <div class="back-to-home">
            <a href="../index.php"> BACK TO HOME </a>
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
   
    
</body>
</html>