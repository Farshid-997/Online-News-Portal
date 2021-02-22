<?php 
    session_start();
    // session_unset($_SESSION['user']);
    // session_unset($_SESSION['user_id']);
    // session_unset($_SESSION['role']);
    session_unset();
    session_destroy();
    header('location: index.php');
    die();

?>
