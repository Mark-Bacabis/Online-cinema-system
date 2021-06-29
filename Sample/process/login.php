<?php
    session_start();
    $conn = mysqli_connect('localhost','root','','online_ticket_reservation');

    $email = $_POST['email'];
    $pass = $_POST['password'];


    if(isset($_POST['login-btn'])){
        $select = mysqli_query($conn, "SELECT * FROM user");

        $result = $select-> fetch_assoc();

        if($email == $result['email'] && $pass == $result['password']){
            $_SESSION['userID'] = $result['userID'];
            header('location:../index.php');
        }
        else{
            header('location:../index.php?Failed');
        }
    }


    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header('location:../index.php');
    }

?>
