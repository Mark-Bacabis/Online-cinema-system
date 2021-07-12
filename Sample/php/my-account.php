<?php
    session_start();
    error_reporting(0);
    include "../connection.php";
    include "../process/url.php";

    $userID = $_SESSION['userID'];

    $userQuery = mysqli_query($conn, "SELECT * FROM user");
    $user = mysqli_fetch_assoc($userQuery);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/my-account.css">
    <title> My Account | NXTFLIX Online cinema reservation </title>
     <!-- aJax jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<!-- IF USER LOGGED IN OR NOT -->
    <?php
        if(!empty($userID)){?>
            <style>
                .login{
                    display: none;
                }
                .isLogin{
                    display: flex;
                }
            </style>
        <?php } elseif(empty($userID)) { ?>
            <style>
                .login{
                    display: flex;
                }
                .isLogin{
                    display: none;
                }
            </style>

    <?php } ?>
<!-- IF USER LOG IN OR NOT -->

<script>
   $(document).ready(function(){
        $("#search").keyup(function(){
            var search = $("#search").val();
            $.post("./search.php",{
                suggest: search

            }, function(data, status){
                $("#search-box").html(data);
            });
        });
    });
</script>


<body>

    <header>
        <div class="nav-search-area">
            <div class="logo">
                <a href="../index.php"> NXTFLIX <br>
                    <span class="subtitle">
                        Online Ticket Reservation
                    </span>
                </a>   
            </div>

        <!-- SEARCH BAR -->
            <div class="search">
                <input type="search" id="search" placeholder="Search movie">
                <img src="../icon/search.png" class="search-icon">
                
                <div class="search-suggestion" id="search-box">

                </div>
            </div>
        <!-- SEARCH BAR -->
            
            

            <div class="nav-bar-container">

            <!-- IF USER DIDN'T LOGIN -->  
                <div class="login" id="login">
                    <a href="../php/sign-up.php?next=<?=$url?>"> Register </a> 
                    <p> | </p> 
                    <a href="../php/login.php?next=<?=$url?>"> Login </a>
                </div>
            <!-- IF USER DIDN'T LOGIN -->          
            
            <!-- IF USER IS LOGIN -->        
                <div class="isLogin">
                    <?php
                        $userQry = mysqli_query($conn, "SELECT * FROM user WHERE userID = '$userID'");

                        $user = $userQry->fetch_assoc();
                    ?>
                

                    <div class="profile"  id="isLogin">
                        <p> <?=$user['firstName']?> <?=$user['lastName']?></p>
                        <img src="../user-profile/<?=$user['profile']?>" alt="">

                        <img src="../icon/down-filled-triangular-arrow.png" alt="" class="drop-down-icon">
                    </div>
                
                </div>
            <!-- IF USER IS LOGIN -->
            </div>

        </div>

        <!-- NAVIGATION LINK -->
        <div class="nav-bar">
            <ul>
                <li style="border-bottom: 2px solid #bbbbbb;"><a href="../index.php"> Home </a></li>
                <li><a href="../php/allMovies.php?query=Allmovies"> Movies </a></li>
                <li><a href="../php/contact.php"> Contact </a></li>
                <li><a href="../php/about.php"> About us </a></li>
            </ul>
        </div>
        
         <!-- USER MODAL -->
         <div class="user-login-container">
                <ul>
                    <form action="../process/account-process.php" method="post">
                    <li> <button class="chngePW" name="my-account"> My Account </button> </li>
                    <li> <button class="bkHistory" name="booking-history"> Booking history </button> </li>
                    <li> <button class="logout" type="submit" name="logout"> Logout  </button> </li>
                    </form>
                </ul>
            </div>
        <!-- USER MODAL -->
    </header>   
   

    <div class="my-account-container">
       
        <div class="account-profile">
            <img src="../user-profile/<?=$user['profile']?>" alt="My Profile">
        <form action="../process/account-profile-process.php" method="POST">
            <input type="file" name="image" id="image">
            <button type="submit" class="change-profile"> Change Profile </button>
        </form>
        </div>
        
        <div class="my-account-info">
            <table border="0" class="info">
                <tr>
                    <td> Fullname </td>
                    <td> <?=$user['firstName']?> <?=$user['lastName']?> </td>
                </tr>
                <tr>
                    <td> Gender </td>
                    <td> <?=$user['Gender']?> </td>
                </tr>
                <tr>
                    <td> Birthday </td>
                    <td> <?=$user['Birthday']?> </td>
                </tr>
                <tr>
                    <td> Contact number </td>
                    <td> <?=$user['contactNumber']?> </td>
                </tr>
                <tr>
                    <td> Email </td>
                    <td> <?=$user['email']?> </td>
                </tr>
            </table>

            <table border="0" class="change-pass">
            <form action="../process/account-profile-process.php" method="POST">
                <tr>
                    <td> Old Password </td>
                    <td> <input type="password"></td>
                </tr>
                <tr>
                    <td> New Password </td>
                    <td> <input type="password"></td>
                </tr>
                <tr>
                    <td> Re-type Password </td>
                    <td> <input type="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td> <input type="submit" value="Change Password"></td>
                </tr>
            </form>
            </table>
        
        </div>


    </div>





<!-- FOOTER -->
    <footer class="footer-container">
        <div class="About">
            <h3> About </h3>
            <ul>
                <li><a href="./php/about.php"> About us</a></li>
                <li><a href="./php/terms-and-condition.php"> Terms and agreement </a></li>
                <li><a href="./php/privacy.php"> Privacy Policy </a></li>
            </ul>
        </div>
        <div class="movies">
                <h3> Movies </h3>
            <ul>
                <li><a href="#slider-container"> All movies </a></li>
                <li><a href="#movie-this-week"> Showing this week </a></li>
                <li><a href="#"> Premiere </a></li>
                <li><a href="#"> Upcoming movie </a></li>
            </ul>
        </div>
        <div class="links">
                 <h3> Links </h3>
            <ul>
                <li><a href="./index.php"> Home </a></li>
                <li><a href="./php/allMovies.php"> Movies</a></li>
                <li><a href="./php/about.php"> About us</a></li>
                <li><a href="./php/contact.php"> Contact Us </a></li>
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





<!-- SCRIPTS --> 
<script src="./scripts/main.js"> </script>
<!-- SCRIPTS --> 
</body>
</html>