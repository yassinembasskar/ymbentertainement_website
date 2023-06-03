<?php
    $error = "";
    if(isset($_SESSION['error'])){
        $error_artcl = $_SESSION['error'];
    } else {
        $error_artcl = "";
    }
    include 'connection.php';
    $select = "SELECT * FROM admin WHERE creator_admin = '1'";
    $result = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($result);
    $admin_name1 = $row['USERNAME_ADMIN'];
    $admin_id1 = $row['ID_ADMIN'];
    if (isset($_POST['add_admin'])){
        $new_admin_name = $_POST['new_admin_name'];
        $password_new = $_POST['password_new'];
        $select_1 = "SELECT * FROM abonne WHERE email_abonne = '$new_admin_name' OR username_abonne = '$new_admin_name'";
        $result_1 = mysqli_query($conn, $select_1);
        $select_2 = "SELECT * FROM admin WHERE username_admin = '$new_admin_name'";
        $result_2 = mysqli_query($conn, $select_2);
        if(mysqli_num_rows($result_1) > 0 || mysqli_num_rows($result_2) > 0){
            $error = "Some of the information you've submitted already exists";
        } else {
            $insert = "INSERT INTO admin (username_admin, password_admin, creator_admin) VALUES('$new_admin_name','$password_new', '0')";
            mysqli_query($conn, $insert);
            mysqli_close($conn);
            header("Location: admin.php");
            exit();
        }
    }
    if (isset($_POST['delete_admin'])) {
        $admin_id = $_POST['admin_id'];
        $select_3 = "DELETE FROM admin WHERE id_admin = $admin_id";
        mysqli_query($conn, $select_3);
    }
    if (isset($_POST['save_admin'])) {
        $admin_id = $_POST['admin_id'];
        $admin_name = $_POST['delete_admin_name'];
        $admin_password_delete = $_POST['password_delete'];
        $select_4 = "UPDATE admin SET username_admin = '$admin_name', password_admin = '$admin_password_delete' WHERE id_admin = $admin_id";
        mysqli_query($conn, $select_4);
    }
    if (isset($_POST['delete_article'])) {
        $article_id = $_POST['article_id0'];
        $select_article = "SELECT * FROM article WHERE id_artcl = $article_id";
        $result_article = mysqli_query($conn, $select_article);
        $row_article = mysqli_fetch_assoc($result_article);
        $path_to_image = $row_article['MAIN_IMG_ARTCL'];
        $category = $row_article['ID_CATEG'];
        $select_categ = "SELECT * FROM categorie WHERE id_categ = '$category'";
        $result_categ = mysqli_query($conn,$select_categ);
        $row_categ= mysqli_fetch_assoc($result_categ);
        $article_categ_name = $row_categ['NAME_CATEG'];
        $path_to_file = "categories/".$article_categ_name."/article".$article_id.".php";
        $select_delete_comments = "DELETE FROM comments WHERE id_artcl = $article_id";
        mysqli_query($conn, $select_delete_comments);
        $select_delete_article = "DELETE FROM article WHERE id_artcl = $article_id";
        mysqli_query($conn, $select_delete_article);
        unlink($path_to_image);
        unlink($path_to_file);
    }
    if (isset($_POST['save_article'])) {
        $article_id = $_POST['article_id0'];
        $article_title = $_POST['article_title'];
        $article_description = $_POST['article_desc'];
        $article_content = $_POST['article_content'];
        $article_categ_name=$_POST['category'];
        $select_categ = "SELECT * FROM categorie WHERE name_categ = '$article_categ_name'";
        $result_categ = mysqli_query($conn,$select_categ);
        $row_categ= mysqli_fetch_assoc($result_categ);
        $article_categ_id = $row_categ['ID_CATEG'];
        $select_4 = "UPDATE article SET title_artcl = '".mysqli_real_escape_string($conn, $article_title)."', description_artcl = '".mysqli_real_escape_string($conn, $article_description)."', content_artcl = '".mysqli_real_escape_string($conn, $article_content)."' ,id_categ = '$article_categ_id'   WHERE id_artcl = $article_id";
        mysqli_query($conn, $select_4);
        if( isset($_FILES['main_img_edit']) && $_FILES['main_img_edit']['error'] === UPLOAD_ERR_OK){
            $new_main_image = $_FILES['main_img_edit'];
            $fileName = $new_main_image['name'];
            $fileTmpPath = $new_main_image['tmp_name'];
            $fileSize = $new_main_image['size'];
            $uploadDir = 'img/'.$article_categ_name.'/';
            $uniqueFileName = uniqid() . "_" . $fileName;
            $targetFilePath = $uploadDir . $uniqueFileName;
            move_uploaded_file($fileTmpPath, $targetFilePath);
            $select5 = "SELECT * FROM article where id_artcl= '$article_id'";
            $result5= mysqli_query($conn, $select5);
            $row5 = mysqli_fetch_assoc($result5);
            $artcl_main_img = $row5['MAIN_IMG_ARTCL'];
            unlink($artcl_main_img);
            $select5 = "UPDATE article SET main_img_artcl = '$targetFilePath' WHERE id_artcl= $article_id";
            mysqli_query($conn, $select5);
        }    
    }
    if(isset($_POST['delete_comment'])){
        $comment_id = $_POST['comment_id'];
        $select_3 = "DELETE FROM comments WHERE id_comment = $comment_id";
        mysqli_query($conn, $select_3);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YMB entertainement - Admin</title>
    <link rel="stylesheet" href="css/admin.css">
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
                    <a href="index.php"><li>Home</li></a>
                    <a href="categories/movies.php"><li>Movies</li></a>
                    <a href="categories/gaming.php"><li>Gaming</li></a>
                    <a href="categories/tv_shows.php"><li>TV Shows</li></a>
                    <a href="categories/anime.php"><li>Anime</li></a>
                    <a href="categories/music.php"><li>Music</li></a>
                    <a href="admin.php"><li class="active">Admin</li></a>
                    <a href="logout.php"><li>Logout</li></a>
                </ul>
            </div>
            <!--the search-->
            <div id="search_place"></div>
            <!--the menu-->
            <div class="shown icon content menu_icon" id="menu_icon" onclick="show_menu();"></div>
            <div class="hidden icon content quit_icon" id="quit_icon" onclick="hide_menu();"></div>
        </div>
    </header>
    <main class="admin_page">
        <section class="admin_list">
            <h2>admins</h2>
            <div class="table">
            <div class="titles">
                <ul>
                    <li>admin id</li>
                    <li>username</li>
                    <li>delete</li>
                    <li>edit</li>
                </ul>
            </div>
            <div class="content">
                <ul>
                    <li><?php echo "$admin_id1" ?></li>
                    <li><?php echo "$admin_name1" ?></li>
                    <li></li>
                    <li></li>
                </ul>
                <?php
                    $select = "SELECT * FROM admin WHERE creator_admin = '0'";
                    $result = mysqli_query($conn,$select);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            $admin_id0 = $row['ID_ADMIN'];
                            $admin_name0 = $row['USERNAME_ADMIN'];
                            $admin_password= $row['PASSWORD_ADMIN'];
                            echo' 
                            <form action="admin.php" method="post">
                <ul>
                    <li>'.$admin_id0.'</li>
                    <li class="shown_admin_'.$admin_id0.'">'.$admin_name0.'</li>
                    <li class="hidden_admin_'.$admin_id0.' hidden_li"><input type="text" autocomplete="off" value="'.$admin_name0.'" required name="delete_admin_name"></li>
                    <input type="hidden" value="'.$admin_id0.'" name="admin_id">
                    <li  class="shown_admin_'.$admin_id0.'"><input type="submit" id="delete_admin_'.$admin_id0.'" name="delete_admin" value="delete"></li>

                    <li class="hidden_li hidden_admin_'.$admin_id0.'"><input type="password" name="password_delete" id="password_'.$admin_id0.'" value="'.$admin_password.'" placeholder="password" minlength="8" required></li>
                    <li class="shown_admin_'.$admin_id0.' edit_admin"><input type="button" id="edit_admin" name="edit_admin" value="edit" onclick="show_admin('.$admin_id0.');"></li>
                    <li class="hidden_li hidden_admin_'.$admin_id0.'"><input type="submit" value="save" name="save_admin"></li>
                </ul>
            </form>';
                        }
                    }
                ?>
            </div>
            <div class="add_admin">
                <form action="" method="POST">
                <ul>
                    <li><?php if ($error != "") {
                        echo "$error";
                    } else {
                        echo "next";
                    }
                        ?></li>
                    <li><input type="text" autocomplete="off" name="new_admin_name" id="new_admin_name" required placeholder="username"></li>
                    <li><input type="password" id="password_new" name="password_new" required minlength="8" placeholder="password"></li>
                   
             <li><input type="submit" id="add_admin" name="add_admin" value="add"></li>
                </ul>
            </form>
        </div>
        </section>
        <section class="article_list">
            <h2>articles</h2>
            <div class="table">
            <div class="titles">
                <ul>
                    <li>article id</li>
                    <li>category</li>
                    <li>title</li>
                    <li>description</li>
                    <li>image source</li>
                    <li>content</li>
                    <li>delete</li>
                    <li>edit</li>
                </ul>
            </div>
            <div class="content">
            <?php
                    $select1 = "SELECT * FROM article";
                    $result1 = mysqli_query($conn,$select1);
                    if(mysqli_num_rows($result1)>0){
                        while($row1 = mysqli_fetch_assoc($result1)){
                            $article_id = $row1['ID_ARTCL'];
                            $article_title = $row1['TITLE_ARTCL'];
                            $article_desc = $row1['DESCRIPTION_ARTCL'];
                            $article_content = $row1['CONTENT_ARTCL'];
                            $article_main_image = $row1['MAIN_IMG_ARTCL'];
                            $article_categ = $row1['ID_CATEG'];
                            $select_categ = "SELECT * FROM categorie WHERE id_categ = '$article_categ'";
                            $result_categ = mysqli_query($conn,$select_categ);
                            $row_categ= mysqli_fetch_assoc($result_categ);
                            $article_categ_name = $row_categ['NAME_CATEG'];
                            if($article_categ_name == "movies"){
                                $categ=["selected", "", "", "", ""];
                            } elseif($article_categ_name == "tv_shows"){
                                $categ=["", "selected", "", "", ""];
                            } elseif($article_categ_name == "anime"){
                                $categ=["", "", "selected", "", ""];
                            } elseif($article_categ_name == "gaming"){
                                $categ=["", "", "", "selected", ""];
                            } elseif($article_categ_name == "music"){
                                $categ=["", "", "", "", "selected"];}
                            echo "
                            <form action='admin.php' method='POST' enctype='multipart/form-data'>
                            <ul>
                                <li>".$article_id."</li>
                                <li class='shown_article_".$article_id."'>".$article_categ_name."</li>
                                <li class='hidden_li hidden_article_".$article_id."'><select name='category' id='select_categ_".$article_id."' required>
                                    <option value=''></option>
                                    <option value='movies' ".$categ[0].">movies</option>
                                    <option value='tv_shows' ".$categ[1].">tv shows</option>
                                    <option value='anime' ".$categ[2].">anime</option>
                                    <option value='gaming' ".$categ[3].">gaming</option>
                                    <option value='music' ".$categ[4].">music</option>
                                </select></li>
                                <li class='shown_article_".$article_id."'>".$article_title."</li>
                                <li class='hidden_li hidden_article_".$article_id."'><input type='text' value='".$article_title."' name='article_title' required></li>
                                <li class='shown_article_".$article_id."'>".$article_desc."</li>
                                <li class='hidden_li hidden_article_".$article_id."'><input name='article_desc' type='text' value='".$article_desc."' required></li>
                                <li class='shown_article_".$article_id."'><img src='".$article_main_image."' alt='image of article ".$article_id."'></li>
                                <li class='hidden_li hidden_article_".$article_id."'><input type='file' accept='image/jpeg, image/png' name='main_img_edit'></li>
                                <li class='shown_article_".$article_id."'>".$article_content."</li>
                                <li class='hidden_li hidden_article_".$article_id."'><textarea name='article_content' required>".$article_content."</textarea>
                                <input type='hidden' value='".$article_id."' name='article_id0'>
                                <li class='shown_article_".$article_id."'><input type='submit' id='delete_article_".$article_id."' name='delete_article' value='delete'></li>
                                <li class='shown_article_".$article_id."'><input type='button' id='edit_article_".$article_id."' name='edit_article_".$article_id."' value='edit' onclick='edit_article(".$article_id.");'></li>
                                <li class='hidden_li hidden_article_".$article_id."'><input type='submit' name='save_article' value='save'></li>

                            </ul>
                        </form>";
                        }};?>
            </div>
            <div class="add_article">
                <form action="add_article.php" method="post" enctype="multipart/form-data">
                <ul>
                    <li><?php if($error_artcl != ""){echo $error_artcl; $_SESSION['error']="";}else{echo "next";}?></li>
                    <li><select name="category_new" id="select_categ_new" required>
                        <option value=""></option>
                        <option value="movies">movies</option>
                        <option value="tv_shows">tv shows</option>
                        <option value="anime">anime</option>
                        <option value="gaming">gaming</option>
                        <option value="music">music</option>
                    </select></li>
                    <li><input type="text" name="title_article_new" autocomplete="off" required></li>
                    <li><input type="text" name="description_article_new" autocomplete="off" required></li>
                    <li><input type="file" accept="image/jpeg, image/png" name="main_img_new" required></li>
                    <li><textarea name="content_article_new" required></textarea></li>
                    <li><input type="submit" id="add_article" name="add_article" value="add"></li>
                    <li></li>
                </ul>
            </form>
            </div>
        </div>
        </section>
        <section class="comments_list">
            <h2>comments</h2>
            <div class="table">
            <div class="titles">
                <ul>
                    <li>article id</li>
                    <li>comment id</li>
                    <li>username</li>
                    <li>content</li>
                    <li>delete</li>
                </ul>
            </div>
            <div class="content">
                <?php
                    $select_comments = "SELECT * FROM comments";
                    $result = mysqli_query($conn,$select_comments);
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            $userame = $row['USERNAME_ABONNE'];
                            $comment_content= $row['CONTENT_COMMENT'];
                            $comment_article= $row['ID_ARTCL'];
                            $comment_id = $row['ID_COMMENT'];
                            echo "<form action='admin.php' method='post'><ul>
                            <li>".$comment_article."</li>
                            <li>".$comment_id."</li>
                            <li>".$userame."</li>
                            <li>".$comment_content."</li>
                            <input type='hidden' value='".$comment_id."' name='comment_id'>
                            <li><input type='submit' id='delete_comment' name='delete_comment' value='delete'></li>
                        </ul></form>";
                        }}
                ?>
            </div>
        </div>
    </section>
    </main>
    <footer>
        <div class="high_footer">
            <div class="ymb_navigation">
                <h2>Explore YMB entertainement:</h2>
                <ul class="container">
                    <a href="index.php"><li>Home</li></a>
                    <a href="categories/movies.php"><li>Movies</li></a>
                    <a href="categories/gaming.php"><li>Gaming</li></a>
                    <a href="tv_shows.php"><li>TV Shows</li></a>
                    <a href="categories/anime.php"><li>Anime</li></a>
                    <a href="categories/music.php"><li>Music</li></a>
                    <a href="logout.php"><li>Logout</li></a>
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