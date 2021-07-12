<?php
   error_reporting(0);
   session_start();
   include "../connection.php";
   include "../process/url.php";
   
   $movieTitle = $_GET['movie'];  
   $userID = $_SESSION['userID'];

   $_SESSION['url'] = $url;



   $selectMovie = mysqli_query($conn, "SELECT * FROM `movie` WHERE Title = '$movieTitle'");

   $movieSelected = $selectMovie->fetch_assoc();

   $movieID = $movieSelected['movieID'];
   $_SESSION['movieID'] = $movieID;


   $movieByGenre = mysqli_query($conn, "SELECT * FROM movie WHERE movieID != '$movieID' AND 
   isAvailable = 'True' AND Genre LIKE '%' || (SELECT LEFT(Genre, 6) as similarGenre FROM movie WHERE movieID = '$movieID') || '%' LIMIT 4");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/privacy.css">
    <title> About Us | NXTFLIX Online Ticket Reservation </title>
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

    <!-- AJAX FOR SEARCH -->
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
            <li><a href="../index.php"> Home </a></li>
            <li><a href="../php/allMovies.php?query=Allmovies"> Movies </a></li>
            <li><a href="../php/contact.php"> Contact </a></li>
            <li style="border-bottom: 2px solid #bbbbbb;"><a href="../php/about.php"> About us </a></li>
        </ul>
    </div>
    
        <!-- USER MODAL -->
            <div class="user-login-container">
                <ul>
                    <form action="../process/account-process.php?next=<?=$url?>" method="post">
                    <li> <button class="chngePW" name="my-account"> My Account </button> </li>
                    <li> <button class="bkHistory" name="booking-history"> Booking history </button> </li>
                    <li> <button class="logout" type="submit" name="logout"> Logout  </button> </li>
                    </form>
                </ul>
            </div>
        <!-- USER MODAL -->
</header>
    
    <div class="about">
        <h1> About us </h1>
        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint reprehenderit incidunt, fuga assumenda natus, doloremque animi facilis at magni tempore, voluptatibus aperiam eaque dolorum qui ea repudiandae cum. Amet aliquam minus similique fugit odio qui quod. Explicabo at odit magnam laboriosam eum sapiente illo corrupti quis deserunt quia totam tempore non nihil atque magni et culpa harum dolor dicta, labore quasi? Repudiandae vel iste architecto? Eveniet laboriosam labore mollitia autem consequatur architecto iure molestias iusto commodi, sunt harum consequuntur cumque incidunt dolorum similique! Eveniet, placeat! Sint recusandae, hic deserunt rem sapiente illum adipisci magnam maxime similique id asperiores laudantium assumenda!</p> <br>
 
        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis autem ipsum vel nesciunt hic aliquid officia non rerum voluptatibus dolorum doloribus magnam voluptatum perspiciatis ad suscipit, earum necessitatibus, aut, id natus iure quaerat provident asperiores! Ducimus ea molestias mollitia voluptate hic molestiae dolorem animi illo amet beatae. Soluta, iusto dicta!</p> <br>

        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto ipsa, corrupti quos aspernatur non impedit repellendus aperiam nisi laudantium voluptatum possimus atque. Maiores, repudiandae non?</p>
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

<!-- CUSTOM JS -->
<script src="./scripts/main.js"> </script>

</body>
</html>