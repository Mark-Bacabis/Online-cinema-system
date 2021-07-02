<?php
    
    session_start();
    error_reporting(0);
    include "../connection.php";

    
    $movieTitle = $_GET['movie'];  
    $userID = $_SESSION['userID'];

    $query = $_GET['query'];

    echo $movieTitle;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/allMovies.css">
    <?php
        if($query == 'Allmovies'){
            $selectMovies = mysqli_query($conn, "SELECT * FROM movie WHERE isAvailable = 'True'");
            echo "<title> All movies </title>";
            echo "                  
                <script>
                    document.getElementById('title').innerHTML = 'Coming soon';
                </script>
            ";
        }
        elseif($query == 'ComingSoon'){
            $selectMovies = mysqli_query($conn, "SELECT * FROM movie WHERE isAvailable = 'False'");
            echo "<title> Coming Soon </title>";
        }
    
    ?>
</head>

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
                    $userQry = mysqli_query($conn, "SELECT * FROM user WHERE userID = '$userID'");

                    $user = $userQry->fetch_assoc();
                ?>
                <div class="fullname">
                    <p> <?=$user['firstName']?> </p>
                </div>

                <div class="profile"  id="isLogin">
                    <img src="../user-profile/<?=$user['profile']?>" alt="">
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




<!-- ALL MOVIES -->
    <div class="all-movies-container">
        <h1 id="title"> All movies </h1>

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