<?php
    $conn = mysqli_connect('localhost', 'root', '', 'ymbentertainement');

    if(!$conn){
        die(mysqli_error($conn));
    }
    session_start();
    
    if (!isset($_SESSION['is_user']) || !isset($_SESSION['is_admin'])){
        $_SESSION['is_admin']=false;
        $_SESSION['is_user']=false;
    }
    

?>