<?php
    session_start();

    if (!isset($_SESSION['isAdmin'])){
        //First we check wether isAdmin exists, which means he is logged in
        
        header('Location: index.php');
    }

?>
