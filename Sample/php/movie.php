
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


    $movieByGenre = mysqli_query($conn, "SELECT * FROM movie WHERE movieID != '$movieID'  AND Genre LIKE '%' || (SELECT LEFT(Genre, 6) as similarGenre FROM movie WHERE movieID = '$movieID') || '%' LIMIT 4");
    
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/movies.css">
    <title> <?=$movieSelected['Title']?> | NXTFLIX - Online Ticket Reservation </title>
    <!-- aJax jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    
</head>
    <!-- aJax Java Script -->
<script>
   $(document).ready(function(){

      $("#available-date").change(function(){
          var movieID = $("#movieID").val();
          var dateValue = $("#available-date").val();
          $.post("process.php", {
              date: dateValue,
              movieIdentifier: movieID
          }, function(data, status){
                $("#available-cinema").html(data);
          });
      });
   });

   $(document).ready(function(){
        $("#available-cinema").change(function(){
            var cinemaValue = $("#available-cinema").val();
            $.post("process.php", {
                cinemaID: cinemaValue

            }, function(data, status){
                $("#showTime").html(data);
            });
        });
    });

    $(document).ready(function(){
        
        $("#showTime").change(function(){
            var movieID = $("#movieID").val();
            var showID = $("#showTime").val();
            $.post("process.php", {
                showID: showID,
                movieIdentifier: movieID
            }, function(data, status){
                $("#price").html(data);
            });
        });
    });
</script>


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
            <li><a href="../php/allMovies.php?query=Allmovies"> Movies </a></li>
            <li><a href="../php/contact.php"> Contact </a></li>
            <li><a href="../php/service.php"> About us </a></li>
        </ul>
    </div>
    
    <!-- USER MODAL -->
        <div class="user-login-container">
            <ul>
                <li> <button class="chngePW"> My Account </button> </li>
                <li> <button class="chngePW"> Change password </button> </li>
                <li> <button class="bkHistory"> Booking history </button> </li>
                <form action="../process/account-process.php?next=<?=$url?>" method="post">
                    <li> <button class="logout" type="submit" name="logout"> Logout  </button> </li>
                </form>
            </ul>
        </div>
    <!-- USER MODAL -->
</header>


<!-- MOVIE INFO -->
<div class="movie-info-container">
    <h1 class="title"> Movie Details </h1>

    <div class="trailer">
        <iframe class="youtube-video" src="<?=$movieSelected['Trailer']?>?autoplay=0" controls="0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"  allowfullscreen></iframe>
    </div>

    <div class="movie-details">
        <div class="poster">
                <img src="../img/<?=$movieSelected['Poster']?>" alt="">
        </div>
        <div class="movie-info">
                <table border="0">
                    <tr>
                        <td> <h1> <?=$movieSelected['Title']?> </h1></td>
                    </tr>
                    <tr>
                        <td> <h2> <?=$movieSelected['Year']?> </h2> </td>
                    </tr>
                    <tr>
                        <td> <h3> <?=$movieSelected['Duration']?> &bullet; <?=$movieSelected['Genre']?> &bullet; <?=$movieSelected['Rating']?> </h3>  </td>
                    </tr>
                    <tr>
                        <td> 
                            <h3> Description </h3>
                            <p> <?=$movieSelected['Description']?></p> 
                        </td>
                    </tr>
                    <tr>
                        <td> 
                            <h3> Director </h3>
                            <p> <?=$movieSelected['Director']?> </p>
                        </td>
                    </tr>
                    <tr>
                        <td> 
                            <h3> Cast </h3>
                            <p> <?=$movieSelected['Cast']?> </p>
                        </td>
                    </tr>
                </table>
        </div>

        <div class="similar-movie">
            <h3> Similar movies </h3>
            <div class="movie-holder">

            <?php while($row = $movieByGenre->fetch_assoc()){?>
                <a href="movie.php?movie=<?=$row['Title']?>"><img src="../img/<?=$row['Poster']?>"></a>
            <?php } ?>
            </div>
        </div>
    </div>


    <?php
        $movieIdentifier = $movieSelected['movieID'];
        
        $getDate = "SELECT DISTINCT availableDate FROM `movie_available_date`
        WHERE movieID = '$movieIdentifier'";

        $movieDates = mysqli_query($conn, $getDate);
    ?>


    <div class="details-transact">
        <input type="text" id="movieID" style="display: none" value="<?=$movieIdentifier?>">
            <form action="./seat-picker.php" method="POST">
                <table border="0">
                    <tr>
                        <td> <h3> Available Date </h3> </td>
                        <td>
                            <select name="availableDate" id="available-date" required>
                                    <option value=""> Select Available Date </option>
                                    <?php while($dateRows = $movieDates->fetch_assoc()){?>
                                        <option value="<?=$dateRows['availableDate']?>"> <?=$dateRows['availableDate']?> </option>
                                    <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>  <h3> Available Cinema </h3> </td>
                        <td>
                            <select name="availableCinema" id="available-cinema" required>
                                <option value=""> Select Available Cinema </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> <h3>Available Shows </h3> </td>
                        <td>
                            <select name="showTime" id="showTime" required>
                                <option value=""> Select Available Show </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> <h3> Ticket Price: </h3> </td>
                        <td class="price"> 
                            <p id="price" name="price"> 
                                <input type="text" name="price" value="0.00"> 
                            </p> 
                            <div class="not">
                                
                            </div>
                        </td>
                        <td> <button type="submit" name="submit"> Book now </button> </td>
                    </tr>
                </table>
                
                
            </form>
    </div>
</div>

<!-- IF NO MOVIE --> 
<div class="getError">
    <div class="message">
        <h1> No selected movie. </h1>
        <p> Please select a movie first</p>
    </div>
</div>
<!-- IF NO MOVIE --> 



<!-- FOOTER -->
    <footer class="footer-container">
        <div class="About">
            <h3> About </h3>
            <ul>
                <li><a href="./about.php"> About us</a></li>
                <li><a href="./terms-and-condition.php"> Terms and agreement </a></li>
                <li><a href="./privacy.php"> Privacy Policy </a></li>
                <li><a href="./service.php"> Services </a></li>
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
                <li><a href="../index.php"> Home </a></li>
                <li><a href="./allMovies.php"> Movies</a></li>
                <li><a href="./contact.php"> Contact Us </a></li>
                <li><a href="./service.php"> Services </a></li>
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
                <li><a href="#"><img src="../icon/facebook.png" alt=""></a></li>
                <li><a href="#"><img src="../icon/twitter.png" alt=""></a></li>
                <li><a href="#"><img src="../icon/instagram.png" alt=""></a></li>
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