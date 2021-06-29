
<?php
    
    error_reporting(0);
    session_start();
    $conn = mysqli_connect('localhost','root','','online_ticket_reservation');

    
    $movieTitle = $_GET['movie'];  
    $userID = $_SESSION['userID'];

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
    <link rel="stylesheet" href="../styles/movies.css">

    <!-- aJax jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title> <?=$movieSelected['Title']?> | Details </title>
    
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
            <a href="../index.php"> Logo </a>   
        </div>
        <div class="search">
            <input type="search" placeholder="Search movie, genre, theatre and address">
            <button> Search </button>
        </div>
    <!-- IF USER DIDN'T LOGIN -->  
        <div class="login" id="login">
            <img src="../icon/login.png" alt="">
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
            <img src="../icon/light-icon.png" alt="" id="icon">
        </div>
     </div>

    </div>


    
    <div class="nav-bar">
        <ul>
            <li><a href="../index.php"> Home </a></li>
            <li><a href="./allMovies.php?query=Allmovies"> Movies </a></li>
            <li><a href="./contact.php"> Contact us</a></li>
            <li><a href="./service.php"> Services </a></li>
        </ul>
    </div>

    <!-- LOGIN MODAL --> 
    <div class="login-container">
        <form action="../process/login.php" method="POST">
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
            <button> <img src="../icon/google.png" alt=""> </button>
            <button> <img src="../icon/facebook.png" alt=""> </button>
        </div>
        <div class="reg"> 
            <p> Don't have an account? </p> 
            <a href="#"> Register now </a>
        </div>
    </div>

  <!-- USER MODAL -->
    <div class="user-login-container">
            <ul>
                <form action="../process/login.php" method="post">
                    <li> <button class="chngePW"> Change password </button> </li>
                    <li> <button class="bkHistory"> Booking history </button> </li>
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
                </table>
        </div>

        <div class="similar-movie">
            <h3> Similar movies </h3>
            <div class="movie-holder">

            <?php while($row = $movieByGenre->fetch_assoc()){?>
                <a href="movie.php?movie=<?=$row['Title']?>"> <img src="../img/<?=$row['Poster']?>" alt=""> </a>
            <?php }?>
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
                            <select name="availableDate" id="available-date">
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
                            <select name="availableCinema" id="available-cinema">
                                <option value=""> Select Available Cinema </option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td> <h3>Available Shows </h3> </td>
                        <td>
                            <select name="showTime" id="showTime">
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
    <script src="./scripts/light-dark-mode.js"></script>
</body>

</html>