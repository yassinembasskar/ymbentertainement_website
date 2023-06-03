<?php
    include "../connection.php";
    $name_categ = "tv_shows";
    $select_categ = "SELECT * FROM categorie Where NAME_CATEG = '$name_categ'";
    $result_categ = mysqli_query($conn,$select_categ);
    $row_categ = mysqli_fetch_assoc($result_categ);
    $id_categ = $row_categ['ID_CATEG'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YMB entertainement - TV Shows</title>
    <link rel="stylesheet" href="../css/category.css">
    <link rel="stylesheet" href="../css/standard.css">
</head>
<body>
    <!-- this is the header that containes the navigation of the website and the search for article and the logo -->
    <header class="container">
        <!--the logo-->
        <div class="content logo header_item first_item">
            <a href="../index.php"><h1 class="oswald_bold" id>YMB Entertainement</h1></a>
        </div>
        <div class="left_content container">
            <div class="content hidden container nav_menu" id="nav_menu">
                <ul>
                    <form class="container search_form" id="search" action="../search.php" method="post">
                        <input class="search_article" type="search" name="search_article" id="search_article" placeholder="Search..." autocomplete="off">
                        <input class="shown icon" type="submit" name="search_icon" id="search_icon" value="">
                    </form>
                    <a href="../index.php"><li>Home</li></a>
                    <a href="movies.php"><li>Movies</li></a>
                    <a href="gaming.php"><li>Gaming</li></a>
                    <a href="tv_shows.php"><li class="active">TV Shows</li></a>
                    <a href="anime.php"><li>Anime</li></a>
                    <a href="music.php"><li>Music</li></a>
                    <?php
                    if ($_SESSION['is_user']) {
                        echo '<a href="../logout.php"><li>Logout</li></a>';
                    } elseif ($_SESSION['is_admin']) {
                        echo '<a href="../admin.php"><li>Admin</li></a>';
                        echo '<a href="../logout.php"><li>Logout</li></a>';
                    } else {
                        echo '<a href="../login.php"><li>Log in</li></a>';
                        echo '<a href="../index.php#sign_up"><li>Sign up</li></a>';
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
    <section class="main container">
        <section class="main_articles">
            <div class="categorie_title"><h1>TV Shows</h1></div>
            <div class="articles_container">
            <?php
                $select = "SELECT * FROM article WHERE id_categ = '$id_categ'";
                $result = mysqli_query($conn,$select);
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        $desc_article = $row['DESCRIPTION_ARTCL'];
                        $title_article = $row['TITLE_ARTCL'];
                        $path_main_img = $row['MAIN_IMG_ARTCL'];
                        $article_id = $row['ID_ARTCL'];
                        echo "
                        <a href='".$name_categ."/article".$article_id.".php'>
                            <div class='mini_article' style='background-image: url(../".$path_main_img.")'>
                                <div class='article_container'>
                                    <h2>".$title_article."</h2>
                                    <div class='description'>".$desc_article."</div>
                                </div>
                            </div>
                        </a>
                    ";}}
                ?>
            </div>
        </section>
        <aside>
            <div class="lists">
            <div class="categorie_title"><h1>Trends</h1></div>
        <div class="articles_container container">
        <?php 
            $select_trends = 'SELECT * FROM article where ID_CATEG != '.$id_categ.' ORDER BY visits_artcl DESC';
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
                echo "<a href='$name_categ/article$id_artcl.php'>
                <div class='mini_article' style='background-image:url(../$img_path)'>
                    <div class='article'>
                        <h2>$title_article</h2>
                        <div class='category'>$name_categ</div>
                    </div>
                </div>
            </a>";
            }
            ?>
        </div>
    </div>
    <div class="lists list_two">
        <div class="categorie_title"><h1>Editor’s picks</h1></div>
    <div class="articles_container container">
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
                echo "<a href='$name_categ/article$id_artcl.php'>
                <div class='mini_article' style='background-image:url(../$img_path)'>
                    <div class='article'>
                        <h2>$title_article</h2>
                        <div class='category'>$name_categ</div>
                    </div>
                </div>
            </a>";
            }
            ?>
        </div>
    </div>
    <div class="lists list_three">
        <div class="categorie_title"><h1>Totally random</h1></div>
    <div class="articles_container container">
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
                echo "<a href='$name_categ/article$id_artcl.php'>
                <div class='mini_article' style='background-image:url(../$img_path)'>
                    <div class='article'>
                        <h2>$title_article</h2>
                        <div class='category'>$name_categ</div>
                    </div>
                </div>
            </a>";
            }
            ?>
    </div>
</div>
        </aside>
    </section>
    <footer>
        <div class="high_footer">
            <div class="ymb_navigation">
                <h2>Explore YMB entertainement:</h2>
                <ul class="container">
                    <a href="../index.php"><li>Home</li></a>
                    <a href="movies.php"><li>Movies</li></a>
                    <a href="gaming.php"><li>Gaming</li></a>
                    <a href="tv_shows.php"><li>TV Shows</li></a>
                    <a href="anime.php"><li>Anime</li></a>
                    <a href="music.php"><li>Music</li></a>
                    <?php
                    if (!$_SESSION['is_user'] && !$_SESSION['is_admin']) {
                        echo '<a href="../login.php"><li>Login</li></a>';
                    } else {
                        echo '<a href="../logout.php"><li>Logout</li></a>';
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
    <script src="../js/standard.js"></script>
</body>
</html>