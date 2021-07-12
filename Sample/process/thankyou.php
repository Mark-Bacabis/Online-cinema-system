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

   
    //FOR TRANSACTION 
    $bookQuery = mysqli_query($conn, "SELECT * FROM `booking_tbl` b
    JOIN movie m
    ON b.movieID = m.movieID
    JOIN cinema c
    ON b.cinemaID = c.cinemaID
    JOIN show_time s
    ON b.showID = s.showID
    JOIN user u
    ON b.userID = u.userID
    WHERE b.bookID = '$transactID'");
    $bookResult = mysqli_fetch_assoc($bookQuery);

    $dateBooked = $bookResult['dateBooked'];

    $cinemaID = $bookResult['cinemaID'];
    $showID =  $bookResult['showID'];

    // GET DATE NAME
    $dateQuery = mysqli_query($conn, "SELECT DAYNAME('$dateBooked') AS Result");
    $dateName = mysqli_fetch_assoc($dateQuery);
    // FOR SEATS 
    $seatQuery = mysqli_query($conn, "SELECT * FROM `seat_tbl` WHERE userID = '$userID' AND movieID = '$movieID' AND date = '$date' AND cinemaID = '$cinemaID' AND showID = '$showID'");



    $email_to = $bookResult['email'];
    $subject = "NXTFLIX";
    
    $header = "MIME-Version: nxtflix.online.system.demo@gmail.com\r\n";
    $header .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
     
    $message = "<h2 style='color: black;'>Hello! ".$bookResult['firstName']." ".$bookResult['lastName'].", the image attached below is/are your ticket for movie reservation </h2>";

    $message .= '<html> <body style="display: block;">';
    while ($selSeats = mysqli_fetch_assoc($seatQuery)){
    $message .='  <div class="tickets" style="margin: 5px 0;">
                    <div class="ticket-container" style="
                        font-family: poppins;
                        width: 600px;
                        height: 200px;
                        background: rgb(37, 37, 37);
                        display: flex;
                        overflow: hidden;
                        margin: 0;">

                        <div class="info" style=" background: whitesmoke;
                        margin: 0;
                        padding: 2% 5%;
                        width: 80%;
                        color: black;
                        line-height: 30px;">
                            <p style="margin:0; padding: 0;"> Transaction ID: '.$transactID.'</p>
                            <h1 style="margin: 0; color: black;">'.$bookResult['Title'].' ('.$bookResult['Year'].')</h1>
                            <h2 style="margin: 0; color: black;">'.$bookResult['dateBooked'].', '.$dateName['Result'].'</h2>
                            <h4 style="margin: 0; color: black;"> Fairview Terraces, '.$bookResult['cinemaName'].'</h4>
                            <h4 style="margin: 0; color: black;">'.$bookResult['showName'].','.$bookResult['showStart'].' - '.$bookResult['showEnd'].' </h4>
                            
                            <p style="font-size: 14px; margin: 0; padding: 0;"> 2021-07-12, 5:05PM </p>
                        </div>
                        <div class="seat-number" style="
                            position: relative; 
                            width: 10%;
                            padding: 4% 9%;">
                            
                            <h1 style="font-size: 60px; 
                            color: white;"> 
                            '.$selSeats['seatNumber'].'
                            </h1>

                        </div>
                    </div>
        </div>';
        }
        $message .= '</body> </html> ';

    mail($email_to, $subject, $message, $header);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if(empty($transactID) && empty($movieID) && empty($userID)){
        header("Location:../index.php");
    } else { ?>
    <meta http-equiv="refresh" content="5; url=http://localhost/online-cinema-system/sample/index.php">
    <?php } ?>

    <link rel="stylesheet" href="../styles/thankyou.css">
    <title>Document</title>
</head>
<style>
    .message{
        position: absolute;
        bottom: 1%;
        left: 1%;
    }
</style>
<body>
    <div class="container">
        <p class="message"> This page will be redirected in 5secs... </p>
        <div class="thankyou-box">
            <img src="../icon/checked-crimson.png" alt="">
            <h1> THANK YOU!! </h1>
            <p> For choosing <span> NXTFLIX </span></p>
            <hr>
            <p> Your booking for </p>
            <h2>  <?=$bookResult['Title']?> (<?=$bookResult['Year']?>) </h2>
            <p> on </p>
            <h3> <?=$date?> (<?=$showTime?>)</h3>
            <p> at </p>
            <h3> Fairview Terraces, <?=$cinema?></h3>
            <p> are confirm! </p>
            <p> Your transaction ID is <font color="crimson"><b> <?=$transactID?> </font> </b></p>
            <p>  We also send your transaction details to this email <font color="crimson"> <?=$bookResult['email']?> </font></p>
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