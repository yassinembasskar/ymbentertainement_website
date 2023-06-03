<?php
    $error = "";
    include "../../connection.php";
    $filePath = __FILE__;
    $repositoryName = basename($filePath);
    $pattern = '/(\d+)/';
    preg_match($pattern, $repositoryName, $matches);
    $number = $matches[0];
    $select = "SELECT * from article where id_artcl='$number'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result)==1) {
        $row = mysqli_fetch_assoc($result);
        $article_id = $row['ID_ARTCL'];
        $article_title = $row['TITLE_ARTCL'];
        $article_descreption = $row['DESCRIPTION_ARTCL'];
        $article_content = $row['CONTENT_ARTCL'];
        $article_content = str_replace("\n", "</p><p class='content'>", $article_content);
        $article_main_img = $row['MAIN_IMG_ARTCL'];
        $category = $row['ID_CATEG'];
        $visits_article = $row['VISITS_ARTCL'] + '1';
        $update_visits = "UPDATE article SET visits_artcl = '$visits_article' WHERE id_artcl= '$article_id'";
        mysqli_query($conn, $update_visits);
    }
    if (isset($_POST['add_comment'])) {
        $comment = $_POST['user_comment'];
        if(!isset($_SESSION['username'])){
            $error = "<p style='color:red'>you must login to be able to comment</p>";
        } else {
            if($_SESSION['is_user']){
                $select = "SELECT * FROM abonne Where username_abonne = '".$_SESSION['username']."'";
                $result = mysqli_query($conn, $select);
                $row = mysqli_fetch_assoc($result);
                $abonne_id = $row['ID_ABONNE'];
                $insert = "INSERT INTO comments (id_artcl, username_abonne, content_comment, id_abonne) VALUES ('$article_id', '".$_SESSION['username']."','".mysqli_real_escape_string($conn,$comment)."','$abonne_id')";
                mysqli_query($conn, $insert);
            } else {
                $error = "<p style='color:red'>you must login as a user</p>";
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
    <title>YMB entertainement - <?php echo $article_title;?></title>
    <link rel="stylesheet" href="../../css/article.css">
    <link rel="stylesheet" href="../../css/category.css">
    <link rel="stylesheet" href="../../css/standard.css">
</head>
<body>
    <!-- this is the header that containes the navigation of the website and the search for article and the logo -->
    <header class="container">
        <!--the logo-->
        <div class="content logo header_item first_item">
            <a href="../../index.php"><h1 class="oswald_bold">YMB Entertainement</h1></a>
        </div>
        <div class="left_content container">
            <div class="content hidden container nav_menu" id="nav_menu">
                <ul>
                    <form class="container search_form" id="search" action="../../search.php" method="post">
                        <input class="search_article" type="search" name="search_article" id="search_article" placeholder="Search..." autocomplete="off">
                        <input class="shown icon" type="submit" name="search_icon" id="search_icon" value="">
                    </form>
                    <a href="../../index.php"><li>Home</li></a>
                    <a href="../movies.php"><li class="<?php if($category=="3"){echo "active";}?>">Movies</li></a>
                    <a href="../gaming.php"><li class="<?php if($category=="2"){echo "active";}?>">Gaming</li></a>
                    <a href="../tv_shows.php"><li class="<?php if($category=="4"){echo "active";}?>">TV Shows</li></a>
                    <a href="../anime.php"><li class="<?php if($category=="1"){echo "active";}?>">Anime</li></a>
                    <a href="../music.php"><li class="<?php if($category=="5"){echo "active";}?>">Music</li></a>
                    <?php
                    if ($_SESSION['is_user']) {
                        echo '<a href="../..logout.php"><li>Logout</li></a>';
                    } elseif ($_SESSION['is_admin']) {
                        echo '<a href="../../admin.php"><li>Admin</li></a>';
                        echo '<a href="../../logout.php"><li>Logout</li></a>';
                    } else {
                        echo '<a href="../../login.php"><li>Login</li></a>';
                        echo '<a href="../../index.php#sign_up"><li>Sign up</li></a>';
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
            <h1><?php echo $article_title;?></h1>
            <img src="../../<?php echo $article_main_img;?>" alt="main image">
            <p class="content">
                <?php echo $article_content;?>
            </p>
            <div class="comments">
                <form action="" method="post">
                    <textarea name="user_comment" id="comments" placeholder="add a comment..."></textarea>
                    <input type="submit" id="send_btn" name="add_comment" value="send">
                </form>
                <?php if($error!=""){echo $error;}?>
                <div class="comments_holder">
                    <?php
                        $select = "SELECT * FROM comments WHERE id_artcl = '$article_id'";
                        $result = mysqli_query($conn,$select);
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                                $userame = $row['USERNAME_ABONNE'];
                                $comment_content= $row['CONTENT_COMMENT'];
                                echo "
                        <div class='comment_holder'>
                            <p class='username'>@".$userame."</p>
                            <p>".$comment_content."</p>
                        </div>
                        ";}}
                    ?>
                </div>
            </div>
        </section>
        <aside>
            <div class="lists">
            <div class="categorie_title"><h1>Trends</h1></div>
        <div class="articles_container container">
        <?php 
            $select_trends = 'SELECT * FROM article where ID_ARTCL != '.$article_id.' ORDER BY visits_artcl DESC';
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
                echo "<a href='../$name_categ/article$id_artcl.php'>
                <div class='mini_article' style='background-image:url(../../$img_path)'>
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
                echo "<a href='../$name_categ/article$id_artcl.php'>
                <div class='mini_article' style='background-image:url(../../$img_path)'>
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
                echo "<a href='../$name_categ/article$id_artcl.php'>
                <div class='mini_article' style='background-image:url(../../$img_path)'>
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
                    <a href="../../index.php"><li>Home</li></a>
                    <a href="../movies.php"><li>Movies</li></a>
                    <a href="../gaming.php"><li>Gaming</li></a>
                    <a href="../tv_shows.php"><li>TV Shows</li></a>
                    <a href="../anime.php"><li>Anime</li></a>
                    <a href="../music.php"><li>Music</li></a>
                    <?php
                    if (!$_SESSION['is_user'] && !$_SESSION['is_admin']) {
                        echo '<a href="../../login.php"><li>Log in</li></a>';
                    } else {
                        echo '<a href="../../logout.php"><li>Logout</li></a>';
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
    <script src="../../js/standard.js"></script>
</body>
</html>