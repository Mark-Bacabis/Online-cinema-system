<?php
    error_reporting(0);
    session_start();
    $_SESSION['next'] = $_GET['next'];
    $getLink = $_SESSION['next'];

    $passwordMatch = $_GET['match'];


    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
    else  
        $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];   

    // Append the requested resource location to the URL   
        $url.= $_SERVER['REQUEST_URI'];    

        $_SESSION['url'] = $url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login-signup.css">
    <title> Sign up now! | NXTFLIX Philippines </title>
</head>

<style>
    .not-match{
        color: red;
        font-size: 11px;
    }
</style>

    <?php if($passwordMatch == 'false') { ?>
        <style>
            .not-match{
                display: flex;
            }
        </style>
    <?php } else { ?>
        <style>
            .not-match{
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
            <h1> Sign Up </h1>
        </div>
    </header>

    <main>
        <div class="bg-img">
            
        </div>
        <form action="../process/account-process.php" method="POST">
            <div class="title-form-sign-up">
                Sign Up
            </div>
            <div class="input-container">
                <input type="text" name="firstname" placeholder="First name"> <br>
                <input type="text" name="lastname" placeholder="Lastname">  <br>
                <input type="text" name="contact-number" maxlength="11" minlength="11" placeholder="Contact number">  <br>
                <input type="gmail" name="email" placeholder="john.done@gmail.com"> 
                <br>
                <input type="password" name="password" placeholder="Password 8-16 characters only" maxlength="16" minlength="8"> 
                <br>
                <input type="password" name="re-password" placeholder="Re-type your password" maxlength="16" minlength="8"> 
                <br>
                
                <p class="not-match"> Password not match </p>
                <input type="submit" name="reg-btn" value="SIGN UP" class="reg-btn">
            </div>

            <div class="log-reg">
                <p> Have an account? <a href="./login.php?next=<?=$getLink?>"> Log In now </a></p>
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