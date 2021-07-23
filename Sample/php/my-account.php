<?php
    session_start();
    error_reporting(0);
    include "../connection.php";
    include "../process/url.php";

    $userID = $_SESSION['userID'];
   
    $userQuery = mysqli_query($conn, "SELECT * FROM user");
    $user = mysqli_fetch_assoc($userQuery);

    if(empty($userID)){
        header("location:../index.php");
    }


    // UPDATE PASSWORD
    if(isset($_POST['change-pass-btn'])){
        $oldPass = $_POST['old-password'];
        $newPass = $_POST['new-password'];
        $retypePass = $_POST['retype-password'];

        if(empty($oldPass) || empty($newPass) || empty($retypePass)){
            echo "<script> alert('Input some data'); </script>";
        }
        else{
            $selUser = mysqli_query($conn, "SELECT * FROM user WHERE userID = '$userID'");
            $user = mysqli_fetch_assoc($selUser);
            if($oldPass === $user['password']){
                // UPDATE PASSWORD
                $passUpdateQuery = "UPDATE `user` SET `password` = '$newPass' WHERE userID = '$userID' ";
                
                if($newPass === $retypePass){
                    $UpdatePass = mysqli_query($conn,$passUpdateQuery);
                    echo "<script> alert('Password Changed'); </script>";
                } 
                else {
                    echo "<script> alert('Your new password and retype password did not match!'); </script>";
                }
            }
            else {
                echo "<script> alert('Enter your correct old password first!'); </script>";
            }
        }
    }


    
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

        $("#re-type").keyup(function(){
            var rPass = $("#re-type").val();
            var nPass = $("#new-pass").val();

            $.post("./search.php",{
                rPassword: rPass,
                nPassword: nPass,

            }, function(data, status){
                $("#err-handling-pass").html(data);
            });
        });

        $("#new-pass").keyup(function(){
            var oldPass = $("#old-pass").val();
            var newPass = $("#new-pass").val();

            $.post("./search.php",{
                oldPassword: oldPass,
                newPassword: newPass,

            }, function(data, status){
                $("#err-handling-old").html(data);
            });
        });

        $("#old-pass").keyup(function(){
            var oPass = $("#old-pass").val();

            $.post("./search.php",{
                oPassword: oPass

            }, function(data, status){
                $("#err-handling-old-pass").html(data);
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
   

    <div class="my-account-container">
       
        <div class="account-profile">
            <div class="profile">
                <img src="../user-profile/<?=$user['profile']?>" alt="My Profile">
            </div>
            
        <form action="../process/account-profile-process.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="image" id="image">
            <button type="submit" name="profile-btn" class="change-profile"> Change Profile </button>
        </form>
        </div>
        
        <div class="my-account-info">
        
            <table border="0" class="info">
            <form action="../process/account-profile-process.php" method="POST">
                <tr>
                    <td> Fullname </td>
                    <td class="fullname">
                        <input type="text" name="fname" value="<?=$user['firstName']?>"> 
                        <input type="text" name="lname" value="<?=$user['lastName']?>">
                    </td>
                </tr>
                <tr>
                    <td> Gender </td>
                    <td> 
                        <input type="text" name="gender" value="<?=$user['Gender']?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td> Birthday </td>
                    <td> 
                        <input type="date" name="bday" value="<?=$user['Birthday']?>" disabled>
                    </td>
                </tr>
                <tr>
                    <td> Contact number </td>
                    <td> 
                        <input type="text" name="cnum" value="<?=$user['contactNumber']?>" minlength="11" maxlength="11"> 
                    </td>
                </tr>
                <tr>
                    <td> Email </td>
                    <td>  
                        <input type="email" name="email" value="<?=$user['email']?>" disabled> 
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="button" style="border-bottom:none;"> 
                        <button type="submit" id="change" name="update"> Update</button>
                    </td>
                </tr>
                </form>
            </table>
        

            <table border="0" class="change-pass">
            <form action="my-account.php" method="POST">
                <tr>
                    <td> Old Password </td>
                    <td> <input type="password" id="old-pass" name="old-password"></td>
                    <p id="err-handling-old-pass"> </p> 
                
                </tr>
                <tr>
                    <td> New Password </td>
                    <td> <input type="password" id="new-pass" name="new-password" minlength="8" maxlength="16"></td>
                    <p id="err-handling-old"> </p> 
                </tr>
                <tr>
                    <td> Re-type Password </td>
                    <td> <input type="password" id="re-type" name="retype-password" minlength="8" maxlength="16"> </td>
                    <p id="err-handling-pass"> </p> 
                </tr>
                <tr>
                    <td></td>
                    <td> <input type="submit" id="change-pass" name="change-pass-btn" value="Change Password"></td>
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


<style>
#err-handling-pass{
    position: absolute;
    top: 83%;
    left: 71%;
    z-index: 10;
}
#err-handling-old{
    position: absolute;
    top: 76%;
    left: 71%;
    z-index: 10;
}
#err-handling-old-pass{
    position: absolute;
    top: 69%;
    left: 71%;
    z-index: 10;
}
</style>


<!-- SCRIPTS --> 
<script src="./scripts/main.js"> </script>
<!-- SCRIPTS --> 
</body>
</html>