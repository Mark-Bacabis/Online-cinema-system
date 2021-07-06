<?php
    session_start();
    error_reporting(0);
    include "./connection.php";
    include "./process/url.php";
    
    $dateToday = DATE('Y-m-d');

    $userID = $_SESSION['userID'];

// SELECT ALL MOVIES
    $select = "SELECT * FROM movie 
    ORDER BY movie.movieID DESC";

    $query = mysqli_query($conn, $select);

    $firstData  = mysqli_query($conn, "SELECT * FROM movie 
    ORDER BY movie.movieID DESC LIMIT 1");

    $secondData  = mysqli_query($conn, "SELECT * FROM movie 
    ORDER BY movie.movieID DESC LIMIT 1,1");

    $lastData  = mysqli_query($conn, "SELECT * FROM movie 
    ORDER BY movie.movieID ASC LIMIT 1");

    $lastImage = $lastData-> fetch_assoc();
    $firstImage = $firstData-> fetch_assoc();
    $secondImage = $secondData-> fetch_assoc();
// SELECT ALL MOVIES

// SELECT SHOWING THIS WEEK MOVIE
    $showThisWeek = mysqli_query($conn, "SELECT * FROM movie ORDER BY movieID DESC LIMIT 5");
// SELECT SHOWING THIS WEEK MOVIE

// SELECT MOVIE THAT SHOWS NEXT WEEK
    $premiere = mysqli_query($conn, "SELECT * FROM movie WHERE isAvailable = 'True' ORDER BY movieID DESC LIMIT 5");
// SELECT MOVIE THAT SHOWS NEXT WEEK

// SELECT MOVIE THAT IS NOT AVAILABLE
    $comingSoon = mysqli_query($conn, "SELECT * FROM movie WHERE isAvailable = 'False' ORDER BY movieID DESC LIMIT 5");
// SELECT MOVIE THAT IS NOT AVAILABLE

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> NXTFLIX | Online Ticket Reservation </title>
    <link rel="stylesheet" href="./styles/style.css">
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
            $.post("./process/search.php",{
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
            <a href="./index.php"> NXTFLIX <br>
                <span class="subtitle">
                    Online Ticket Reservation
                </span>
            </a>   
        </div>

    <!-- SEARCH BAR -->
        <div class="search">
            <input type="search" id="search" placeholder="Search movie">
            <img src="./icon/search.png" class="search-icon">
            
            <div class="search-suggestion" id="search-box">

            </div>
        </div>
    <!-- SEARCH BAR -->
        
        

        <div class="nav-bar-container">

        <!-- IF USER DIDN'T LOGIN -->  
            <div class="login" id="login">
                <a href="./php/sign-up.php?next=<?=$url?>"> Register </a> 
                <p> | </p> 
                <a href="./php/login.php?next=<?=$url?>"> Login </a>
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
                    <img src="./user-profile/<?=$user['profile']?>" alt="">

                    <img src="./icon/down-filled-triangular-arrow.png" alt="" class="drop-down-icon">
                </div>
            
            </div>
        <!-- IF USER IS LOGIN -->
        </div>

    </div>

    <!-- NAVIGATION LINK -->
    <div class="nav-bar">
        <ul>
            <li style="border-bottom: 2px solid #bbbbbb;"><a href="./index.php"> Home </a></li>
            <li><a href="./php/allMovies.php?query=Allmovies"> Movies </a></li>
            <li><a href="./php/contact.php"> Contact us</a></li>
            <li><a href="./php/service.php"> About </a></li>
            <li><a href="./php/privacy.php"> Privacy Policy </a></li>
        </ul>
    </div>
    
    <!-- USER MODAL -->
        <div class="user-login-container">
            <ul>
                <li> <button class="chngePW"> My Account </button> </li>
                <li> <button class="chngePW"> Change password </button> </li>
                <li> <button class="bkHistory"> Booking history </button> </li>
                <form action="./process/account-process.php?next=http://localhost/online-cinema-system/sample/index.php" method="post">
                    <li> <button class="logout" type="submit" name="logout"> Logout  </button> </li>
                </form>
            </ul>
        </div>
    <!-- USER MODAL -->
</header>



<!-- ALL MOVIES -->
    <div class="slider-container" id="slider-container">
            <ul class="slide-holder">
                <li class="imgHolder" id="lastImage"> 
                        <div class="overlay">
                            <div class="movie-text">
                                <a href="./php/movie.php?movie=<?=$lastImage['Title']?>"> 
                                    <?=$lastImage['Title'] ?> (<?= $lastImage['Year']?>)
                                </a>
                                <p> <?= $lastImage['Duration']?> &bullet; <?=$lastImage['Genre']?> &bullet; <?= $lastImage['Rating']?></p>   
                            </div>
                        </div>

                        <img src="./img/<?=$lastImage['Banner']?>" alt="">
                </li>
                
            <?php   
                while($row = $query-> fetch_assoc()){
            ?>
                    <li class="imgHolder">

                        <div class="overlay">
                            <div class="movie-text">
                                <a href="./php/movie.php?movie=<?=$row['Title']?>">
                                
                                    <?=$row['Title'] ?> (<?= $row['Year']?>)
                                </a>
                                <p> <?= $row['Duration']?> &bullet; <?=$row['Genre']?> &bullet; <?= $row['Rating']?></p>   
                            </div>
                        </div>
                    
                       
                        <img src="./img/<?= $row['Banner']?>" alt="">
                    </li>  
            <?php
                }
            ?>
                <li class="imgHolder" > 
                        <div class="overlay">
                            <div class="movie-text">
                                <a href="./php/movie.php?movie=<?=$firstImage['Title']?>"> 
                                    <?=$firstImage['Title'] ?>  (<?= $firstImage['Year']?>)
                                </a>
                                <p> <?= $firstImage['Duration']?> &bullet; <?=$firstImage['Genre']?> &bullet; <?= $firstImage['Rating']?></p>   
                            </div>
                        </div>
                    
                       
                        <img src="./img/<?= $firstImage['Banner']?>" alt="">
                </li>

                <li class="imgHolder"> 
                        <div class="overlay">
                            <div class="movie-text">
                                <a href="./php/movie.php?movie=<?=$secondImage['Title']?>"> 
                                    <?=$secondImage['Title'] ?>  (<?= $secondImage['Year']?>)
                                </a>
                                <p> <?= $secondImage['Duration']?> &bullet; <?=$secondImage['Genre']?> &bullet; <?= $secondImage['Rating']?></p>   
                            </div>
                        </div>
                    
                       
                        <img src="./img/<?=$secondImage['Banner']?>" alt="">
                </li>

            </ul>
        <button id="prevBtn"> 
            <img src="./icon/previous.png" alt=""> 
        </button>
        <button id="nxtBtn">
            <img src="./icon/next.png" alt="">
        </button>

    </div>
<!-- ALL MOVIES -->

<div class="bg-blur">
    <div class="bottom-gradient">

    </div>
</div>

<!-- SHOWING THIS WEEK -->
    <div class="movie-container showing-week-container" id="movie-this-week">
        <div class="container-title">
            <h1> SHOWING THIS WEEK </h1>
            <a href="#" class="see-all">
                See all
            </a>
        </div>
        <ul>
            <?php
                while($weeklyShow = $showThisWeek-> fetch_assoc()){
            ?>
            <li>
                <div class="movie-poster-box">
                    <div class="movie-poster">
                        <img src="./img/<?=$weeklyShow['Poster']?>" alt="">
                    </div>
                    <div class="movie-title">
                        <a href="./php/movie.php?movie=<?=$weeklyShow['Title'];?>"> <?=$weeklyShow['Title']?> </a>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
<!-- SHOWING THIS WEEK -->


<!-- SHOWING NEXT WEEK -->
    <div class="movie-container premiere-container">
        <div class="container-title">
            <h1> PREMIERE </h1>
            <p> Showing Next Week </p>
            <a href="#" class="see-all">
                See all
            </a>
        </div>
        <ul>
            <?php
                while($nextWeekShow = $premiere-> fetch_assoc()){
            ?>
            <li>
                <div class="movie-poster-box">
                    <div class="movie-poster">
                        <img src="./img/<?=$nextWeekShow['Poster'];?>" alt="">
                    </div>
                    <div class="movie-title">
                        <a href="./php/movie.php?movie=<?=$nextWeekShow['Title'];?>"> <?=$nextWeekShow['Title'];?> </a>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
<!-- SHOWING NEXT WEEK -->


<!-- COMING SOON -->
    <div class="movie-container coming-soon-container">
        <div class="container-title">
            <h2> Coming Soon </h2>
        </div>
        <ul>
            <li>
                <div class="movie-poster-box">
                    <div class="movie-poster">
                        <img src="./img/raya-poster.jpg" alt="">
                    </div>
                    <div class="movie-title">
                        <p>
                            Movie Title (2020)
                        </p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
<!-- COMING SOON -->





<!-- FOOTER -->
    <footer class="footer-container">
        <div class="About">
            <h3> About </h3>
            <ul>
                <li><a href="#"> About us</a></li>
                <li><a href="./php/terms-and-condition.php"> Terms and agreement </a></li>
                <li><a href="./php/privacy.php"> Privacy Policy </a></li>
                <li><a href="#"> Services </a></li>
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



</body>
<!-- SCRIPTS --> 
    <script src="./javascript/main.js"> </script>
<!-- SCRIPTS --> 
</html>