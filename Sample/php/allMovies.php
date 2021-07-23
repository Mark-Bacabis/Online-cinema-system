<?php
    
    session_start();
    error_reporting(0);
    include "../connection.php";
    include "../process/url.php";

    $dateToday = date('Y-m-d');
    
    //$movieTitle = $_GET['movie'];  
    $userID = $_SESSION['userID'];

    $query = $_GET['query'];

   
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/allMovies.css">
    <!-- aJax jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title> All Movies | NXTFLIX Online Ticket Reservation </title>
</head>

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


<!--if no movie selected -->
    <?php if(empty($movieID)){ ?>
        <style>
            .movie-info-container{
                display: none;
            }
            .getError{
                display: flex;
            }

        </style>
    <?php } else{ ?>
        <style>
            .movie-info-container{
                display: flex;
            }
            .getError{
                display: none;
            }

        </style>
    <?php } ?>
<!--if no movie selected -->

<!--HEADER-->
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
            <li style="border-bottom: 2px solid #bbbbbb;"><a href="../php/allMovies.php?query=Allmovies"> Movies </a></li>
            <li><a href="../php/contact.php"> Contact </a></li>
            <li><a href="../php/about.php"> About us </a></li>
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



<!-- ALL MOVIES -->
    <div class="all-movies-container">
        <?php
             if($query == 'Allmovies'){
                $selectMovies = mysqli_query($conn, "SELECT DISTINCT a.availableDate, b.movieID, b.Title, b.Poster, b.Year, b.Genre, b.Duration, b.Rating FROM `movie_available_date` a
                JOIN movie b
                ON a.movieID = b.movieID
                WHERE a.availableDate >= '$dateToday'
                ORDER BY a.movieID DESC");
                echo "<h1> All Movies </h1>";
            }
            else if($query == 'thisWeek'){
                $monday = strtotime("last monday");
                $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
        
                $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
        
                $this_week_start = date("Y-m-d",$monday);
                $this_week_end = date("Y-m-d",$sunday);
        
                $selectMovies = mysqli_query($conn, "SELECT DISTINCT a.availableDate, b.movieID, b.Title, b.Poster, b.Year, b.Genre, b.Duration, b.Rating FROM `movie_available_date` a
                JOIN movie b
                ON a.movieID = b.movieID
                WHERE a.availableDate BETWEEN '$this_week_start' AND '$this_week_end' AND availableDate >= '$dateToday' ORDER BY a.availableDate");

                echo "<h1> Movies this week </h1>";
            }
            else if($query == 'nextWeek'){

                $next_week = strtotime('next week');
                $date_monday = date("Y-m-d", strtotime('monday', $next_week));
                $date_sunday = date("Y-m-d", strtotime('sunday', $next_week)); 
                
                $selectMovies = mysqli_query($conn, "SELECT DISTINCT a.availableDate, b.movieID, b.Title, b.Poster, b.Year, b.Genre, b.Duration, b.Rating FROM `movie_available_date` a
                JOIN movie b
                ON a.movieID = b.movieID
                WHERE a.availableDate BETWEEN '$date_monday' AND '$date_sunday' AND availableDate >= '$dateToday' ORDER BY a.availableDate");
                echo "<h1> Movies next week </h1>";
            }
        
        
        ?>

        <ul>
            <?php while ($movieRows = mysqli_fetch_assoc($selectMovies)){ ?>
                <li>
                    <div class="movie-box">
                        <div class="movie-info poster">
                            <img src="../img/<?=$movieRows['Poster']?>" alt="<?=$movieRows['Title']?>">
                        </div>
                        <div class="movie-info title">
                        <a href="movie.php?movie=<?=$movieRows['Title']?>">
                                <p> <?=$movieRows['Title']?> (<?=$movieRows['Year']?>) </p>
                            </a>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
<!-- ALL MOVIES -->




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

<?php
    if($query == 'Allmovies'){;
        echo "                  
            <script>
                document.getElementById('title').innerHTML = 'All movies';
            </script>
        ";
    }
    elseif($query == 'ComingSoon'){
        echo "                  
            <script>
                document.getElementById('title').innerHTML = 'Coming soon';
            </script>
        ";
    }
?>
</html>