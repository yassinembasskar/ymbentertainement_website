<?php
    $error = "";
    include 'connection.php';
    if (isset($_POST['signup'])) {
        $username = $_POST['name_abonne'];
        $email = $_POST["mail"];
        $password = $_POST["password_user"];
        $confirm_password = $_POST["confirm_password"];
        $select_1 = "SELECT * FROM abonne WHERE email_abonne = '$email' OR username_abonne = '$username'";
        $result_1 = mysqli_query($conn, $select_1);
        $select_2 = "SELECT * FROM admin WHERE username_admin = '$username'";
        $result_2 = mysqli_query($conn, $select_2);
        if ($password != $confirm_password) {
            $error = "The two passwords are not identical";
        } elseif (mysqli_num_rows($result_1) > 0 || mysqli_num_rows($result_2) > 0) {
            $error = "Some of the information you've submitted already exists";
        } else {
            $insert = "INSERT INTO abonne(username_abonne, email_abonne, password_abonne) VALUES('$username','$email','$password')";
            mysqli_query($conn, $insert);
            mysqli_close($conn);
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['is_user'] = true;
            $_SESSION['is_admin'] = false;
            header("Location: index.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YMB entertainement - Home</title>
    <link rel="stylesheet" href="css/standard.css">
</head>
<body>
    <!-- this is the header that containes the navigation of the website and the search for article and the logo -->
    <header class="container">
        <!--the logo-->
        <div class="content logo header_item first_item">
            <a href="index.php"><h1 class="oswald_bold" id>YMB Entertainement</h1></a>
        </div>
        <div class="left_content container">
            <div class="content hidden container nav_menu" id="nav_menu">
                <ul>
                    <form class="container search_form" id="search" action="search.php" method="post">
                        <input class="search_article" type="search" name="search_article" id="search_article" placeholder="Search..." autocomplete="off">
                        <input class="shown icon" type="submit" name="search_icon" id="search_icon" value="">
                    </form>
                    <a href="index.php"><li class = "active">Home</li></a>
                    <a href="categories/movies.php"><li>Movies</li></a>
                    <a href="categories/gaming.php"><li>Gaming</li></a>
                    <a href="categories/tv_shows.php"><li>TV Shows</li></a>
                    <a href="categories/anime.php"><li>Anime</li></a>
                    <a href="categories/music.php"><li>Music</li></a>
                    <?php
                    if ($_SESSION['is_user']) {
                        echo '<a href="logout.php"><li>Logout</li></a>';
                    } elseif ($_SESSION['is_admin']) {
                        echo '<a href="admin.php"><li>Admin</li></a>';
                        echo '<a href="logout.php"><li>Logout</li></a>';
                    } else {
                        echo '<a href="login.php"><li>Log in</li></a>';
                        echo '<a href="index.php#sign_up"><li>Sign up</li></a>';
                    }
                    ?>
                    
                </ul>
            </div>
            <!--the search-->
            <div id="search_place"></div>
            <!--the menu-->
            <div class="shown icon content menu_icon" id="menu_icon" onclick="show_menu();"></div>
            <div class="hidden icon content quit_icon" id="quit_icon" onclick="hide_menu();"></div>
        </div>
    </header>
    <!-- this is the main where i will put the most recent news and scroll to see them all -->
    <main id="recent_news">
        <!--this is a red icon that contain NEW-->
        <!--this is the ligne that have the most recent 5 news-->
        <div class="container main_info" id="main_info">
            <?php
                $select_recent = "SELECT * FROM article ORDER BY id_artcl DESC";
                $result_recent = mysqli_query($conn,$select_recent);
                for ($i=0; $i < 5; $i++) { 
                    $row_recent = mysqli_fetch_assoc($result_recent);
                    $article_id = $row_recent['ID_ARTCL'];
                    $img_path = $row_recent['MAIN_IMG_ARTCL'];
                    $title_article = $row_recent['TITLE_ARTCL'];
                    $description_article = $row_recent['DESCRIPTION_ARTCL'];
                    $id_categ = $row_recent['ID_CATEG'];
                    $select_categ = "SELECT * FROM categorie Where ID_CATEG = '$id_categ'";
                    $result_categ = mysqli_query($conn,$select_categ);
                    $row_categ = mysqli_fetch_assoc($result_categ);
                    $name_categ = $row_categ['NAME_CATEG'];
                    echo "<a href='categories/$name_categ/article$article_id.php' style='background-image:url($img_path);'>
                    <div class='content article_info'>
                        <div class='article_content'>
                            <h1 id='article_title' class='oswald_bold'>$title_article</h1>
                            <p id='article_desc'>$description_article</p>
                        </div>
                    </div>
                </a>";
                }
            ?>
        </div>
        <div class="fix_icon">NEW</div>
        <!--this is the ligne that has 5 circles to navigate between the 5 main articles-->
        <div class="bottom_recent">
            <div class="container nav_main">
                <div class="content active circle" onclick="clickCircle(0);"></div>
                <div class="content not_active circle" onclick="clickCircle(1);"></div>
                <div class="content not_active circle"  onclick="clickCircle(2);"></div>
                <div class="content not_active circle" onclick="clickCircle(3);"></div>
                <div class="content not_active circle" onclick="clickCircle(4);"></div>
            </div>
        </div>
    </main>
    <section class="cards_container trends" id="trends">
        <div class="head_section"><h1>Trends</h1></div>
        <div class="articles_container">
            <?php 
            $select_trends = 'SELECT * FROM article ORDER BY visits_artcl DESC';
            $result_trends = mysqli_query($conn,$select_trends);
            for ($i=0; $i < 4; $i++) { 
                $row_trends = mysqli_fetch_assoc($result_trends);
                $id_categ = $row_trends['ID_CATEG'];
                $id_artcl = $row_trends['ID_ARTCL'];
                $title_article = $row_trends['TITLE_ARTCL'];
                $img_path = $row_trends['MAIN_IMG_ARTCL'];
                $select_categ = "SELECT * FROM categorie Where ID_CATEG = '$id_categ'";
                $result_categ = mysqli_query($conn,$select_categ);
                $row_categ = mysqli_fetch_assoc($result_categ);
                $name_categ = $row_categ['NAME_CATEG'];
                echo "<a href='categories/$name_categ/article$id_artcl.php'>
                <div class='mini_article' style='background-image:url($img_path)'>
                    <div class='article'>
                        <h2>$title_article</h2>
                        <div class='category'>$name_categ</div>
                    </div>
                </div>
            </a>";
            }
            ?>
        </div>
        

    </section>
    <section class="cards_container editor_picks" id="editor_picks">
        <div class="head_section"><h1>Editor’s Picks</h1></div>
        <div class="articles_container">
        <?php 
            $select_trends = 'SELECT * FROM article where ID_CATEG != '.$id_categ.' ORDER BY visits_artcl ASC';
            $result_trends = mysqli_query($conn,$select_trends);
            for ($i=0; $i < 4; $i++) { 
                $row_trends = mysqli_fetch_assoc($result_trends);
                $id_categ = $row_trends['ID_CATEG'];
                $id_artcl = $row_trends['ID_ARTCL'];
                $title_article = $row_trends['TITLE_ARTCL'];
                $img_path = $row_trends['MAIN_IMG_ARTCL'];
                $select_categ = "SELECT * FROM categorie Where ID_CATEG = '$id_categ'";
                $result_categ = mysqli_query($conn,$select_categ);
                $row_categ = mysqli_fetch_assoc($result_categ);
                $name_categ = $row_categ['NAME_CATEG'];
                echo "<a href='categories/$name_categ/article$id_artcl.php'>
                <div class='mini_article' style='background-image:url($img_path)'>
                    <div class='article'>
                        <h2>$title_article</h2>
                        <div class='category'>$name_categ</div>
                    </div>
                </div>
            </a>";
            }
            ?>
        </div>
        

    </section>
    <section class="cards_container month_articles" id="month_articles">
        <div class="head_section"><h1>Totally random</h1></div>
        <div class="articles_container">
        <?php 
            $select_trends = 'SELECT * FROM article where ID_CATEG != '.$id_categ.' ORDER BY RAND()';
            $result_trends = mysqli_query($conn,$select_trends);
            for ($i=0; $i < 4; $i++) { 
                $row_trends = mysqli_fetch_assoc($result_trends);
                $id_categ = $row_trends['ID_CATEG'];
                $id_artcl = $row_trends['ID_ARTCL'];
                $title_article = $row_trends['TITLE_ARTCL'];
                $img_path = $row_trends['MAIN_IMG_ARTCL'];
                $select_categ = "SELECT * FROM categorie Where ID_CATEG = '$id_categ'";
                $result_categ = mysqli_query($conn,$select_categ);
                $row_categ = mysqli_fetch_assoc($result_categ);
                $name_categ = $row_categ['NAME_CATEG'];
                echo "<a href='categries/$name_categ/article$id_artcl.php'>
                <div class='mini_article' style='background-image:url($img_path)'>
                    <div class='article'>
                        <h2>$title_article</h2>
                        <div class='category'>$name_categ</div>
                    </div>
                </div>
            </a>";
            }
            ?>
        </div>
        

    </section>
    
    <section class="sign_up" id="sign_up">
        <?php if(!$_SESSION['is_user'] && !$_SESSION['is_admin']) { ?>
            <form action="" method="post">
                <div class="title_holder">
                    <h1>Sign up to be notified about our articles:</h1>
                </div>
                <div class="fields">
                    <div class="field">
                        <label for="name_abonne">Username:</label>
                        <input type="text" name="name_abonne" id="name_abonne" autocomplete="off" required>
                    </div>
                    <div class="field">
                        <label for="mail">Email:</label>
                        <input type="email" name="mail" id="mail" autocomplete="off" required>
                    </div>
                    <div class="field">
                        <label for="password_user">Password:</label>
                        <input type="password" name="password_user" id="password_user" minlength="8" required>
                    </div>
                    <div class="field">
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" minlength="8" required>
                    </div>
                </div>
                <?php
                    if ($error!="") {
                        echo "<p style='color:red; margin-left:20px;'>" . $error . "</p>";
                    } 
                ?>
                <input id="btn_submit" name="signup" type="submit" value="submit">
            </form>
        <?php } ?>
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
                    <?php
                    if (!$_SESSION['is_user'] && !$_SESSION['is_admin']) {
                        echo '<a href="login.php"><li>Log in</li></a>';
                    } else {
                        echo '<a href="logout.php"><li>Logout</li></a>';
                    }
                    ?>
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