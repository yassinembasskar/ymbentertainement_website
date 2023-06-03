<?php
    $error = "";
    include 'connection.php';
    if (isset($_POST['login'])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $first_select = "SELECT * FROM abonne WHERE email_abonne = '$email'";
        $first_result = mysqli_query($conn, $first_select);
        $second_select="SELECT * FROM abonne WHERE username_abonne = '$email'";
        $second_result = mysqli_query($conn, $second_select);
        $third_select = "SELECT * FROM admin WHERE username_admin = '$email'";
        $third_result = mysqli_query($conn, $third_select);
        

        if (mysqli_num_rows($first_result) == 1) {
            $user = mysqli_fetch_assoc($first_result);
            if (!empty($user) && $user['PASSWORD_ABONNE'] == $password) {
                $_SESSION['email']=$email;
                $_SESSION['username'] = $user['USERNAME_ABONNE'];
                $_SESSION['is_user'] = true;
                $_SESSION['is_admin']= false;
                header("Location: index.php");
                exit();
            } else {
                $error = 'the password is incorrect';
            }
        } elseif (mysqli_num_rows($second_result) == 1) {
            $user = mysqli_fetch_assoc($second_result);
            if (!empty($user) && $user['PASSWORD_ABONNE'] == $password) {
                mysqli_close($conn);
                $_SESSION['email']=$user['EMAIL_ABONNE'];
                $_SESSION['username'] = $email;
                $_SESSION['is_user'] = true;
                $_SESSION['is_admin']= false;
                header("Location: index.php");
                exit();
            } else {
                $error = 'the password is incorrect';
            }
        } elseif (mysqli_num_rows($third_result) == 1){
            $user = mysqli_fetch_assoc($third_result);
            if (!empty($user) && $user['PASSWORD_ADMIN'] == $password) {
                mysqli_close($conn);
                $_SESSION['email']="admin";
                $_SESSION['username'] = $user['USERNAME_ADMIN'];
                $_SESSION['is_user'] = false;
                $_SESSION['is_admin']= true;
                header("Location: index.php");
                exit();
            } else {
                $error = 'the password is incorrect';
            }
        } else {
            $error = 'this account doesnt exist';
        }
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YMB entertainement - Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/standard.css">
</head>
<body>
    <!-- this is the header that containes the navigation of the website and the search for article and the logo -->
    <header class="container">
        <!--the logo-->
        <div class="content logo header_item first_item">
            <a href="home.php"><h1 class="oswald_bold" id>YMB Entertainement</h1></a>
        </div>
        <div class="left_content container">
            <div class="content hidden container nav_menu" id="nav_menu">
                <ul>
                    <form class="container search_form" id="search" action="search.php" method="post">
                        <input class="search_article" type="search" name="search_article" id="search_article" placeholder="Search..." autocomplete="off">
                        <input class="shown icon" type="submit" name="search_icon" id="search_icon" value="">
                    </form>
                    <a href="index.php"><li>Home</li></a>
                    <a href="categories/movies.php"><li>Movies</li></a>
                    <a href="categories/gaming.php"><li>Gaming</li></a>
                    <a href="categories/tv_shows.php"><li>TV Shows</li></a>
                    <a href="categories/anime.php"><li>Anime</li></a>
                    <a href="categories/music.php"><li>Music</li></a>
                    <a href="Login.php"><li class="active">Log in</li></a>
                    <a href="index.php#sign_up"><li>Sign up</li></a>
                </ul>
            </div>
            <!--the search-->
            <div id="search_place"></div>
            <!--the menu-->
            <div class="shown icon content menu_icon" id="menu_icon" onclick="show_menu();"></div>
            <div class="hidden icon content quit_icon" id="quit_icon" onclick="hide_menu();"></div>
        </div>
    </header>
    <section class="login">
        <h1>log in:</h1>
        <form action="login.php" method="post">
            <div class="form_item email_field">
                <label for="email">Email or Username:</label>
                <input type="text" name="email" id="email" autocomplete="off" required>
            </div>
            <div class="form_item email_field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" minlength="8" autocomplete="off" required>
            </div>
            <?php
                if ($error!="") {
                    echo "<p style='color:red; margin-left:20px;'>" . $error . "</p>";
                } 
            ?>
            <div class="signup_container">
                <a href="home.php#sign_up">sign up</a>
            </div>
            <input class="login" name="login" type="submit" value="Login">
        </form>
    </section>
    <footer>
        <div class="high_footer">
            <div class="ymb_navigation">
                <h2>Explore YMB entertainement:</h2>
                <ul class="container">
                    <a href="index.php"><li>Home</li></a>
                    <a href="categories/movies.php"><li>Movies</li></a>
                    <a href="categories/gaming.php"><li>Gaming</li></a>
                    <a href="categories/tv_shows.php"><li>TV Shows</li></a>
                    <a href="categories/anime.php"><li>Anime</li></a>
                    <a href="categories/music.php"><li>Music</li></a>
                    <a href="Login.php"><li>Log in</li></a>
                </ul>
            </div>
            <div class="contact_us">
                <h2>Contact Us</h2>
                <ul class="container">
                    <a href=""><li></li></a>
                    <a href=""><li></li></a>
                    <a href=""><li></li></a>
                    <a href=""><li></li></a>
                    <a href=""><li></li></a>
                </ul>
            </div>
        </div>
        <div class="copyrights"><p>copyright &copy; Yassine Moutaoikkil Basskar</p></div>
    </footer>
    <script src="js/standard.js"></script>
</body>
</html>