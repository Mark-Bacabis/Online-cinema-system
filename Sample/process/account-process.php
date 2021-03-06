<?php
    session_start();
    include "../connection.php";

    // WHEN REGISTRATION BUTTON IS CLICKED
    if(isset($_POST['reg-btn'])) {    
        $url = $_SESSION['url'];
        $nextLink = $_SESSION['next'];

      

        $cntQry = mysqli_query($conn, "SELECT COUNT(userID) AS cnt FROM user");
        $cntRow = mysqli_fetch_assoc($cntQry);
        $cnt = $cntRow['cnt'];

        $userID = "user-00".($cnt + 1);
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $bday = $_POST['bdate'];
        $gender = $_POST['gender'];
        $contact = $_POST['contact-number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repass = $_POST['re-password'];
        $picture = "default.jpg";

        $insertQry = mysqli_query($conn, "INSERT INTO `user`
        (`userID`, `firstName`, `lastName`, `Gender`, `Birthday`, `contactNumber`, `email`, `password`, `profile`) 
        VALUES 
        ('$userID','$firstname','$lastname','$gender','$bday','$contact','$email','$password','$picture')");

        if(!$insertQry){
            echo error_log($insertQry);
        }else{
            $_SESSION['userID'] = $userID;
            header("Location:".$nextLink);
        }

    }

    // WHEN LOGIN BUTTON IS CLICKED
    if(isset($_POST['login-btn'])){
        $loginUrl = $_SESSION['url'];
        $nextLink = $_SESSION['next'];
        $email = $_POST['email'];
        $pass = $_POST['password'];

        $sel = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' AND password ='$pass'");

        $userAccount = mysqli_fetch_assoc($sel);

        if($email == $userAccount['email'] && $pass == $userAccount['password']){
            $_SESSION['userID'] = $userAccount['userID'];

            header("Location:".$nextLink);
        }
        elseif($email != $userAccount['email'] && $pass != $userAccount['password']){
            header("Location:".$loginUrl."&password=incorrect");
        }
    }

    // WHEN LOGOUT BUTTON IS CLICKED
    if(isset($_POST['logout'])){
        unset($_SESSION['userID']);
        
        $nextLink = $_GET['next'];
        header("Location:".$nextLink);
    }

    // WHEN MY ACCOUNT BUTTON IS CLICKED
    if(isset($_POST['my-account'])){
        header("location:../php/my-account.php");
    }

    // WHEN HISTORY BOOKING BUTTON IS CLICKED
    if(isset($_POST['booking-history'])){
        header("location:../php/booking-history.php");
    }

     // WHEN FEEDBACK BUTTON IS CLICKED
     if(isset($_POST['feedbacks'])){
        header("location:../php/feedbacks.php");
    }

?>
