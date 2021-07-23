<?php
    error_reporting(0);
    session_start();
    include "../process/url.php";

    $_SESSION['next'] = $_GET['next'];
    $getLink = $_SESSION['next'];
    $_SESSION['url'] = $url;

    $passIsCorrect = $_GET['password'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login-signup.css">
    <title> Login now! | NXTFLIX Philippines </title>
</head>
    <style>
        .wrong-pass{
            font-size: 10px;
            color: red;
        }
    </style>
    <?php if($passIsCorrect == "incorrect"){?>
        <style>
        .wrong-pass{
           display: flex;
        }
    </style>
    <?php }else{ ?>
        <style>
        .wrong-pass{
           display: none;
        }
        </style>
    <?php } ?>
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
            <h1> Log In</h1>
        </div>
    </header>

    <main>
        <div class="bg-img">
            
        </div>
        <form action="../process/account-process.php" method="POST">
            <div class="title-form">
                Log In
            </div>
            <div class="input-container">
                <label> Email </label> <br>
                <input type="gmail" name="email" placeholder="john.done@gmail.com" required> 
                <br>
                <label> Password </label> <br>
                <input type="password" name="password" placeholder="8 - 16 characters only" maxlength="16" minlength="8" required> 
                <br>
                <p class="wrong-pass">incorrect password/username </p>
                <input type="submit" name="login-btn" value="LOGIN" class="login-btn">
                <div class="forgot-pass">
                    <a href="#"> Forgot password </a>
                </div>
            </div>

            <div class="log-reg">
                <p> New to NXTFLIX? <a href="./sign-up.php?next=<?=$getLink?>"> Register now </a></p>
            </div>
        </form>
    </main>

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