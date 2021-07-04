<?php
    session_start();
    error_reporting(0);
    include "./connection.php";
    
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

        <div class="search">
            <input type="search" placeholder="Search movie">
            <img src="./icon/search.png" clas="search-icon">
        </div>
        

        <div class="nav-bar-container">

        <!-- IF USER DIDN'T LOGIN -->  
            <div class="login" id="login">
                <a href="#"> Register </a> 
                <p> | </p> 
                <a href="#"> Login </a>
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
                
                   
                <div class="wishlist">
                    <img src="./icon/playlist.png" alt="">
                </div>
            </div>
        <!-- IF USER IS LOGIN -->
        </div>

        <!-- 
        <div class="light-and-dark" id="light-dark">
            <div class="light-mode">
                <p> Light </p>
                <img src="./icon/light-icon.png" alt="" id="icon">
            </div>
        </div>
        -->

    </div>

    <!-- NAVIGATION LINK -->
    <div class="nav-bar">
        <ul>
            <li style="border-bottom: 2px solid #bbbbbb;"><a href="./index.php"> Home </a></li>
            <li><a href="./php/allMovies.php?query=Allmovies"> Movies </a></li>
            <li><a href="./php/contact.php"> Contact us</a></li>
            <li><a href="./php/service.php"> Services </a></li>
        </ul>
    </div>

    <!-- LOGIN MODAL -->
        <div class="login-container">
            <form action="./process/login.php" method="POST">
                <table border="0">
                    <th> Login </th>
                    <tr>
                        <td> <input type="email" name="email" placeholder="Email"></td>
                    </tr>
                    <tr>
                        <td> <input type="password" name="password" placeholder="Password"></td>
                    </tr>
                    <tr>
                        <td> <input type="submit" name="login-btn" placeholder="Password" value="Sign in"></td>
                    </tr>

                    <tr>
                        <td> <a href="#"> Forgot password? </a></td>
                    </tr>
                </table>
            </form>

            <div class="other-account">
                <p> or </p>
                <button> <img src="./icon/google.png" alt=""> </button>
                <button> <img src="./icon/facebook.png" alt=""> </button>
            </div>
            <div class="reg"> 
                <p> Don't have an account? </p> 
                <a href="#"> Register now </a>
            </div>
        </div>
    <!--   LOGIN MODAL 
    --> 

    
    <!-- USER MODAL -->
        <div class="user-login-container">
            <ul>
                <li> <button class="chngePW"> My Account </button> </li>
                <li> <button class="chngePW"> Change password </button> </li>
                <li> <button class="bkHistory"> Booking history </button> </li>
                <form action="./process/login.php" method="post">
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


<!-- SHOWING THIS WEEK -->
    <div class="movie-container showing-week-container">
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



</body>
<!-- SCRIPTS --> 
    <script src="./javascript/main.js"> </script>
<!-- SCRIPTS --> 
</html>