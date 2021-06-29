<?php
    session_start();

    error_reporting(0);
    $conn = mysqli_connect('localhost','root','','online_ticket_reservation');
    $dateToday = DATE('Y-m-d');

    $userID = $_SESSION['userID'];

// SELECT MOVIES BY DATE TODAY
    $select = "SELECT DISTINCT movie.*, mdate.availableDate 
    FROM movie 
    JOIN movie_available_date mdate
    ON movie.movieID = mdate.movieID
    WHERE mdate.availableDate = '2021-06-22'
    ORDER BY movie.movieID DESC";

    $query = mysqli_query($conn, $select);

    $firstData  = mysqli_query($conn, "SELECT DISTINCT movie.*, mdate.availableDate 
    FROM movie 
    JOIN movie_available_date mdate
    ON movie.movieID = mdate.movieID
    WHERE mdate.availableDate = '2021-06-22'
    ORDER BY movie.movieID DESC LIMIT 1");

    $secondData  = mysqli_query($conn, "SELECT DISTINCT movie.*, mdate.availableDate 
    FROM movie 
    JOIN movie_available_date mdate
    ON movie.movieID = mdate.movieID
    WHERE mdate.availableDate = '2021-06-22'
    ORDER BY movie.movieID DESC LIMIT 1,1");

    $lastData  = mysqli_query($conn, "SELECT DISTINCT movie.*, mdate.availableDate 
    FROM movie 
    JOIN movie_available_date mdate
    ON movie.movieID = mdate.movieID
    WHERE mdate.availableDate = '2021-06-22'
    ORDER BY movie.movieID ASC LIMIT 1");

    $lastImage = $lastData-> fetch_assoc();
    $firstImage = $firstData-> fetch_assoc();
    $secondImage = $secondData-> fetch_assoc();
// SELECT MOVIES BY DATE TODAY

// SELECT NEW MOVIE
    $newRelease = mysqli_query($conn, "SELECT * FROM movie ORDER BY movieID DESC LIMIT 5");
// SELECT NEW MOVIE

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
    <title> Online Ticket Reservation </title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<!-- IF USER LOG IN OR NOT -->
    <?php
        if($userID != null){?>
            <style>
                .login{
                    display: none;
                }
                .isLogin{
                    display: flex;
                }
            </style>
        <?php } elseif($userID == null) { ?>
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

<div class="isOff">
    <p id="dark-mode"> </p>
</div>



<header>
    <div class="nav-search-area">
        <div class="logo">
            <a href="./index.php"> Logo </a>   
        </div>

        <div class="search">
            <input type="search" placeholder="Search movie, genre, theatre and address">
            <button> Search </button>
        </div>

        <!-- IF USER DIDN'T LOGIN -->  
            <div class="login" id="login">
                <img src="./icon/login.png" alt="">
            </div>
        <!-- IF USER DIDN'T LOGIN -->  
        
        
        <!-- IF USER IS LOGIN -->        
            <div class="isLogin">
                <?php
                    $firstLetter = mysqli_query($conn, "SELECT firstName, lastName, LEFT(firstName , 1) as FirstLetter,  LEFT(lastName , 1) as LastLetter FROM user WHERE userID = '$userID'");

                    $firstLetterUser = $firstLetter->fetch_assoc();
                ?>
                <div class="fullname">
                    <p> <?=$firstLetterUser['firstName']?> <?=$firstLetterUser['lastName']?> </p>
                </div>

                <div class="profile"  id="isLogin">
                <h1> <?=$firstLetterUser['FirstLetter']?><?=$firstLetterUser['LastLetter']?> </h1>    
                </div>           
            </div>
        <!-- IF USER IS LOGIN -->
        

        <div class="light-and-dark" id="light-dark">
            <div class="light-mode">
                <p> Light </p>
                <img src="./icon/light-icon.png" alt="" id="icon">
            </div>
        </div>

    </div>


    <div class="nav-bar">
        <ul>
            <li><a href="./index.php"> Home </a></li>
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
    <!-- LOGIN MODAL --> 

    
    <!-- USER MODAL -->
        <div class="user-login-container">
            <ul>
                <form action="./process/login.php" method="post">
                    <li> <button class="chngePW"> Change password </button> </li>
                    <li> <button class="bkHistory"> Booking history </button> </li>
                    <li> <button class="logout" type="submit" name="logout"> Logout  </button> </li>
                </form>
            </ul>
        </div>
    <!-- USER MODAL -->
</header>



<!-- NOW SHOWING -->
    <div class="slider-container" id="slider-container">
        <h1> Now Showing </h1>
            <ul class="slide-holder">

                <li class="imgHolder" id="lastImage"> 
                      
                        <div class="overlay">
                            <div class="movie-text">
                                <a href="./php/movie.php?movie=<?=$lastImage['Title']?>" target="blank"> 
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
                                <a href="./php/movie.php?movie=<?=$row['Title']?>" target="blank">
                                
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
                                <a href="./php/movie.php?movie=<?=$firstImage['Title']?>" target="blank"> 
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
                                <a href="./php/movie.php?movie=<?=$secondImage['Title']?>" target="blank"> 
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
<!-- NOW SHOWING -->
    
<!-- SHOWING THIS WEEK -->
    <div class="new-release-container">
        <div class="title-container">
            <h1>Showing this week </h1>
        </div>
        <a href="#" class="see-all"> See all </a>
        <div class="movie-poster">
            <ul>
                <?php
                    while($newReleaseMovie = $newRelease-> fetch_assoc()){
                ?>
                <li>
                    <img src="./img/<?= $newReleaseMovie['Poster']?>"> 
                    <a href="next.php?movieID=1"> View Details </a> 
                </li>  
                <?php } ?>
            </ul>
        </div>
    </div>
<!-- SHOWING THIS WEEK -->

<!-- PREMIERE -->
    <div class="premiere-container">
        <div class="title-container">
            <h1> Premiere </h1>
            <p> Showing next week </p>
        </div>
        <a href="#" class="see-all"> See all </a>
        <div class="movie-poster">
            <ul>
                <?php
                    while($premiereMovie = $premiere-> fetch_assoc()){
                ?>
                <li>
                    <img src="./img/<?=$premiereMovie['Poster']?>"> 
                    <a href="next.php?movieID=1"> View Details </a> 
                </li>  
                <?php } ?>
            </ul>
        </div>
    </div>
<!-- PREMIERE -->

<!-- UPCOMING -->
    <div class="upcoming-container">
        
        <div class="upcoming-title">
            <h2> Coming Soon </h2>
        </div>
        <a href="./php/allMovies.php?query=ComingSoon" class="see-all"> See all </a>
        <div class="poster-container">

        <?php
            while($comingSoonMovie = $comingSoon-> fetch_assoc()){
        ?>
            <div class="upc-movie-poster"> 
                <img src="./img/<?=$comingSoonMovie['Poster']?>">
                <h2> <?=$comingSoonMovie['Title']?> (<?=$comingSoonMovie['Year']?>) </h2>
            </div>
        <?php } ?>
        </div>  
    </div>
<!-- UPCOMING -->

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