<?php
$_SESSION["ERROR"] = "";
include 'connection.php';
if (isset($_POST['add_article'])) {
    $new_category=$_POST['category_new'];
    $select_categ="SELECT * from categorie where name_categ = '$new_category'";
    $result_categ= mysqli_query($conn,$select_categ);
    $new_category_id=mysqli_fetch_assoc($result_categ)['ID_CATEG'];
    $select_admin="SELECT * from admin where username_admin = '".$_SESSION['username']."'";
    $result_admin= mysqli_query($conn,$select_admin);
    $admin_id=mysqli_fetch_assoc($result_admin)['ID_ADMIN'];
    $new_title=$_POST['title_article_new'];
    $new_description=$_POST['description_article_new'];
    $new_content=$_POST['content_article_new'];
    if($_FILES['main_img_new']['error'] === UPLOAD_ERR_OK){
        $new_main_image = $_FILES['main_img_new'];
        $fileName = $new_main_image['name'];
        $fileTmpPath = $new_main_image['tmp_name'];
        $fileSize = $new_main_image['size'];
        $uploadDir = 'img/'.$new_category.'/';
        $uniqueFileName = uniqid() . "_" . $fileName;
        $targetFilePath = $uploadDir . $uniqueFileName;
        $select_new_articles="SELECT * from article where title_artcl='".mysqli_real_escape_string($conn, $new_title)."' or description_artcl='".mysqli_real_escape_string($conn, $new_description)."' or main_img_artcl='$targetFilePath' or content_artcl='".mysqli_real_escape_string($conn, $new_content)."'";
        $result_new_1 = mysqli_query($conn,$select_new_articles);
        if(mysqli_num_rows($result_new_1)>0){
            $_SESSION["error"] = "some of these informations already exists";
            header("location: admin.php");
        } else {
            move_uploaded_file($fileTmpPath, $targetFilePath);
            $insert_new = "INSERT INTO article (main_img_artcl, id_admin, username_admin, title_artcl, description_artcl, content_artcl, id_categ, visits_artcl) VALUES ('$targetFilePath', '$admin_id', '".$_SESSION['username']."', '".mysqli_real_escape_string($conn, $new_title)."', '".mysqli_real_escape_string($conn, $new_description)."', '".mysqli_real_escape_string($conn, $new_content)."', '$new_category_id', '0')";
            mysqli_query($conn,$insert_new);
            $result_new_1 = mysqli_query($conn,$select_new_articles);
            $row = mysqli_fetch_assoc($result_new_1);
            $file = 'categories/'.$new_category.'/article'.$row["ID_ARTCL"].'.php';
            $add_article = fopen($file, 'w');
            $htmlContent = file_get_contents('article_example.php');
            fwrite($add_article, $htmlContent);
            fclose($add_article);
            header("location: admin.php");
            exit();
        }
    }
    
}

?>